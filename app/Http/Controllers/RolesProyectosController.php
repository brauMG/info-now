<?php

namespace App\Http\Controllers;

use App\Areas;
use App\Puesto;
use App\Rol;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Compania;
use App\RolProyecto;
use App\Fase;
use App\Proyecto;
use App\RolRASIC;
use App\User;
use PDF;

class RolesProyectosController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'verified']);
    }
     public function index(){
            $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
            $rolPROYECTO=DB::table('RolesProyectos')
                ->leftJoin('Proyectos', 'RolesProyectos.Clave_Proyecto', '=', 'Proyectos.Clave')
                ->leftJoin('RolesRASIC', 'RolesProyectos.Clave_Rol_RASIC', '=', 'RolesRASIC.Clave')
                ->leftJoin('Usuarios', 'RolesProyectos.Clave_Usuario', '=', 'Usuarios.Clave')
                ->leftJoin('Puestos', 'Usuarios.Clave_Puesto', '=', 'Puestos.Clave')
                ->leftJoin('Fases', 'Proyectos.Clave_Fase', '=', 'Fases.Clave')
                ->select('RolesProyectos.Clave as Clave','Proyectos.Descripcion as Proyecto','Usuarios.Nombres as Usuario','Puestos.Puesto as Puesto','RolesRASIC.RolRASIC as RolRASIC', 'Fases.Descripcion as Fase', 'RolesProyectos.Activo', 'RolesProyectos.FechaCreacion')
                ->where('Proyectos.Clave_Compania','=',Auth::user()->Clave_Compania)
                ->get();
            return view('Admin.RolesProyectos.index',['rolPROYECTO'=>$rolPROYECTO,'compania'=>$compania]);
    }

    public function editStatus($id) {
        $rolProyectoEstado=RolProyecto::where('Clave', $id)->get()->toArray();
        $rolProyectoEstado = $rolProyectoEstado[0];
        $estados= [
            1,
            2
        ];
        return view('Admin.RolesProyectos.editStatus', compact('estados', 'rolProyectoEstado'));
    }

    public function select(){
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
        $companyId =Auth::user()->Clave_Compania;
        $proyectos =  Proyecto::where('Clave_Compania', $companyId)->get();
        return view('Admin.RolesProyectos.select',compact('companyId', 'proyectos', 'compania'));
    }

    public function updateStatus(Request $request, $Clave){
        $status = $request->validate([
            'status' => ['required']
        ]);

        RolProyecto::where('Clave', $Clave)->update([
            'Activo' => $status['status']
        ]);
        return redirect('/Admin/RolesProyectos')->with('mensaje', "El estado del usuario dentro del proyecto fue actualizado correctamente");
    }

    public function new(Request $request){
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
        $proyectoId = $request->input('proyecto');
        $proyecto = Proyecto::where('Clave', $proyectoId)->first();
        $faseId = $proyecto->Clave_Fase;
        $companyId =Auth::user()->Clave_Compania;
        $usuarios = User::where('Clave_Compania', $companyId)->where('Clave_Rol', 3)->orWhere('Clave_Rol', 4)->get();
        $roles = RolRASIC::all();

        return view('Admin.RolesProyectos.new',compact('proyectoId','usuarios', 'roles', 'faseId', 'compania'));
    }

    public function store(Request $request){
        $faseId = $request->input('faseId');
        $proyectoId = $request->input('proyectoId');

        $data = $request->validate([
            'usuario' => ['required'],
            'rol' => ['required']
        ]);

        $i = 0;

        $actualData = RolProyecto::all()->toArray();

        foreach ($actualData as $project) {
            if ($project['Clave_Proyecto'] == $proyectoId){
                if ($project['Clave_Usuario'] == $data['usuario']){
                    $i = 1;
                }
            }
        }

        if ($i == 0) {
            RolProyecto::create([
                'Clave_Proyecto' => $proyectoId,
                'Clave_Fase' => $faseId,
                'Clave_Rol_RASIC' => $data['rol'],
                'FechaCreacion' => Carbon::now(),
                'Activo' => 1,
                'Clave_Usuario' => $data['usuario']
            ]);

            return redirect('/Admin/RolesProyectos')->with('mensaje', "Usuario agregado correctamente al proyecto");
        }
        else {
            return redirect('/Admin/RolesProyectos')->with('mensajeDanger', "Ese usuario ya esta agregado al proyecto");
        }
    }

    public function preparePdf(Request $request) {
        $proyectos=Proyecto::where('Clave_Compania',Auth::user()->Clave_Compania)->get();
        $fases=Fase::where('Clave_Compania',Auth::user()->Clave_Compania)->get();
        $rasics=RolRASIC::all();
        $usuarios=User::where('Clave_Compania',Auth::user()->Clave_Compania)->get();
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();


        return view('Admin.RolesProyectos.prepare', compact('proyectos', 'fases', 'rasics', 'usuarios', 'compania'));
    }

    public function exportPdf(Request $request)
    {
        $proyectos = $request->input('proyectos');
        $fases = $request->input('fases');
        $rasics = $request->input('rasics');
        $usuarios = $request->input('usuarios');
        $datetime = Carbon::now();
        $datetime->setTimezone('GMT-7');
        $date = $datetime->toDateString();
        $time = $datetime->toTimeString();

        $rolesUser = DB::table('RolesProyectos')
            ->join('Proyectos', 'RolesProyectos.Clave_Proyecto', '=', 'Proyectos.Clave')
            ->where(function($query) use ($proyectos, $request) {
                if ($proyectos != null) {
                    $query->whereIn('RolesProyectos.Clave_Proyecto', $proyectos);
                }
            })
            ->join('Fases', 'RolesProyectos.Clave_Fase', '=', 'Fases.Clave')
            ->where(function($query) use ($fases, $request) {
                if ($fases != null) {
                    $query->whereIn('RolesProyectos.Clave_Fase', $fases);
                }
            })
            ->join('RolesRASIC', 'RolesProyectos.Clave_Rol_RASIC', '=', 'RolesRASIC.Clave')
            ->where(function($query) use ($rasics, $request) {
                if ($rasics != null) {
                    $query->whereIn('RolesProyectos.Clave_Rol_RASIC', $rasics);
                }
            })
            ->join('Usuarios', 'RolesProyectos.Clave_Usuario', '=', 'Usuarios.Clave')
            ->where(function($query) use ($usuarios, $request) {
                if ($usuarios != null) {
                    $query->whereIn('RolesProyectos.Clave_Usuario', $usuarios);
                }
            })
            ->select('Proyectos.Descripcion as Proyecto', 'Fases.Descripcion as Fase', 'RolesRASIC.RolRASIC as RolRASIC', 'Usuarios.Nombres as Usuario')
            ->get();

        $pdf = PDF::loadView('pdf.userproject', compact('rolesUser', 'date', 'time'));

        return $pdf->download('roles_en_proyectos.pdf');
    }
}
