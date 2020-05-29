<?php

namespace App\Http\Controllers;
use App\Areas;
use App\Etapas;
use App\RolProyecto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Area;
use App\Compania;
use App\Actividad;
use App\Fase;
use App\Proyecto;
use App\Status;
class ActividadesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->Clave_Rol == 4) {
            $rol = Auth::user()->Clave_Rol;
            $companyId = Auth::user()->Clave_Compania;
            $datetime = Carbon::now();
            $datetime->setTimezone('GMT-7');
            $date = $datetime->toDateString();
            $time = $datetime->toTimeString();
            $compania = Compania::where('Clave', Auth::user()->Clave_Compania)->first();
            $actividad = DB::table('Actividades')
                ->leftJoin('Companias', 'Actividades.Clave_Compania', '=', 'Companias.Clave')
                ->leftJoin('Proyectos', 'Actividades.Clave_Proyecto', '=', 'Proyectos.Clave')
                ->leftJoin('Usuarios', 'Actividades.Clave_Usuario', '=', 'Usuarios.Clave')
                ->leftJoin('Etapas', 'Actividades.Clave_Etapa', '=', 'Etapas.Clave')
                ->leftJoin('Fases', 'Actividades.Clave_Fase', '=', 'Fases.Clave')
                ->select('Actividades.Clave as Clave', 'Companias.Descripcion as Compania', 'Proyectos.Descripcion as Proyecto', 'Etapas.Descripcion as Etapa', 'Fases.Descripcion as Fase', 'Actividades.Descripcion', 'Actividades.Fecha_Vencimiento', 'Actividades.Hora_Vencimiento', 'Actividades.Fecha_Revision', 'Actividades.Hora_Revision', 'Actividades.Decision', 'Usuarios.nombres as Usuario', 'Actividades.FechaCreacion', 'Actividades.Estado')
                ->where('Actividades.Clave_Compania', '=', $companyId)
                ->get();
            return view('Admin.Actividades.index', ['actividad' => $actividad, 'compania' => $compania, 'date' => $date, 'time' => $time, 'rol' => $rol]);
        }

        if (Auth::user()->Clave_Rol == 3) {
            $rol = Auth::user()->Clave_Rol;
            $companyId = Auth::user()->Clave_Compania;
            $datetime = Carbon::now();
            $datetime->setTimezone('GMT-7');
            $date = $datetime->toDateString();
            $time = $datetime->toTimeString();
            $compania = Compania::where('Clave', Auth::user()->Clave_Compania)->first();

            $actividad = DB::table('Actividades')
                ->leftJoin('Companias', 'Actividades.Clave_Compania', '=', 'Companias.Clave')
                ->leftJoin('RolesProyectos', 'Actividades.Clave_Proyecto', '=', 'RolesProyectos.Clave_Proyecto')
                ->leftJoin('Proyectos', 'RolesProyectos.Clave_Proyecto', '=', 'Proyectos.Clave')
                ->leftJoin('Usuarios', 'Actividades.Clave_Usuario', '=', 'Usuarios.Clave')
                ->leftJoin('Etapas', 'Actividades.Clave_Etapa', '=', 'Etapas.Clave')
                ->leftJoin('Fases', 'Actividades.Clave_Fase', '=', 'Fases.Clave')
                ->select('Actividades.Clave as Clave', 'Companias.Descripcion as Compania', 'Proyectos.Descripcion as Proyecto', 'Etapas.Descripcion as Etapa', 'Fases.Descripcion as Fase', 'Actividades.Descripcion', 'Actividades.Fecha_Vencimiento', 'Actividades.Hora_Vencimiento', 'Actividades.Fecha_Revision', 'Actividades.Hora_Revision', 'Actividades.Decision', 'Usuarios.nombres as Usuario', 'Actividades.FechaCreacion', 'Actividades.Estado')
                ->where('Actividades.Clave_Compania', '=', $companyId)
                ->where('RolesProyectos.Clave_Usuario', Auth::user()->Clave)
                ->get();
            return view('Admin.Actividades.index', ['actividad' => $actividad, 'compania' => $compania, 'date' => $date, 'time' => $time, 'rol' => $rol]);
        }
    }

    public function edit($id){
        $actividad=Actividad::where('Clave', $id)->get()->toArray();
        $proyectos=Proyecto::all();
        $fases=Fase::all();
        $status=Status::all();
        return view('Admin.Actividades.edit',compact('actividad','proyectos','fases', 'status'));
    }

    public function editStatus($id) {
        $actividadEstado=Actividad::where('Clave', $id)->get()->toArray();
        $actividadEstado = $actividadEstado[0];
        $estados= [
            1,
            2
        ];
        return view('Admin.Actividades.editStatus', compact('estados', 'actividadEstado'));
    }

    public function updateStatus(Request $request, $Clave){
        $datetime = Carbon::now();
        $datetime->setTimezone('GMT-7');
        $date = $datetime->toDateString();
        $time = $datetime->toTimeString();
        $status = $request->validate([
            'status' => ['required']
        ]);

        Actividad::where('Clave', $Clave)->update([
            'Estado' => $status['status'],
            'Fecha_Revision' => $date,
            'Hora_Revision' => $time
        ]);
        return redirect('/Admin/Actividades')->with('mensaje', "El estado de la revisión fue actualizado correctamente");
    }

    public function type($id){
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
        $proyectoID = $id;
        $datetime = Carbon::now();
        $datetime->setTimezone('GMT-7');
        $date = $datetime->toDateString();
        $etapas = Etapas::where('Clave_Proyecto', $proyectoID)->where('Fecha_Vencimiento', '>', $date)->get();
        return view('Admin.Actividades.type',compact('proyectoID', 'tipos', 'compania', 'etapas'));
    }

    public function new(Request $request, $proyectoID){
        $etapa = $request->input('etapa');
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
        $companiaId=Auth::user()->Clave_Compania;
        $usuarioId=Auth::user()->Clave;

        return view('Admin.Actividades.new',compact('etapa','proyectoID', 'companiaId', 'usuarioId', 'compania'));
    }

    public function store(Request $request){
        $etapa = $request->input('etapa');
        $etapaData = Etapas::where('Clave', $etapa)->first();

        $companiaId= $request->input('compania');
        $proyectoId= $request->input('proyecto');
        $usuarioId= $request->input('usuario');

        $actividad = $request->validate([
            'descripcion' => ['required', 'string', 'max:150'],
            'decision' => ['required', 'string', 'max:150']
        ]);

        Actividad::create([
            'Clave_Compania' => $companiaId,
            'Clave_Proyecto' => $proyectoId,
            'Descripcion' => $actividad['descripcion'],
            'Decision' => $actividad['decision'],
            'FechaCreacion' => Carbon::now(),
            'Estado' => 0,
            'Clave_Usuario' => $usuarioId,
            'Clave_Fase' => $etapaData->Clave_Fase,
            'Clave_Etapa' => $etapaData->Clave,
            'Fecha_Vencimiento' => $etapaData->Fecha_Vencimiento,
            'Hora_Vencimiento' => $etapaData->Hora_Vencimiento,
        ]);

        return redirect('/Admin/Actividades')->with('mensaje', "Nueva actividad agregada correctamente");
    }
    public function delete($id){
        $actividad = Actividad::find($id);

        $actividad->delete();
        return response()->json(['error'=>false]);
    }
    public function update(Request $request){
        $actividad = Actividad::find($request->clave);
        $actividad->Clave_Compania=$request->compania;
        $actividad->Clave_Proyecto = $request->proyecto;
        $actividad->Clave_Fase = $request->fase;
        $actividad->Descripcion = $request->descripcion;
        $actividad->FechaAccion = $request->fechaAccion;
        $actividad->Decision = $request->decision;
        $actividad->Clave_Status = $request->status;
        $actividad->Clave_Proyecto = $request->proyecto;
        $actividad->save();
        return response()->json(['actividad'=>$actividad]);
    }

    public function preparePdf(Request $request) {
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
        return view('Admin.Actividades.prepare', compact('proyectos', 'fases', 'usuarios', 'etapas', 'estados', 'compania'));
    }
}
