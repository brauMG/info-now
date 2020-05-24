<?php

namespace App\Http\Controllers;

use App\RolRASIC;
use App\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Proyecto;
use App\Compania;
use App\User;
use App\Areas;
use App\Fase;
use App\Enfoque;
use App\Trabajo;
use App\Indicador;

class ProyectosController extends Controller
{
	//
	public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $rol = Auth::user()->Clave_Rol;
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();


        if (Auth::user()->Clave_Rol == 4) {
            $proyecto = DB::table('Proyectos')
                ->leftJoin('Companias', 'Proyectos.Clave_Compania', '=', 'Companias.Clave')
                ->leftJoin('Status', 'Status.Clave', '=', 'Proyectos.Clave_Status')
                ->leftJoin('Areas', 'Areas.Clave', '=', 'Proyectos.Clave_Area')
                ->leftJoin('Fases', 'Fases.Clave', '=', 'Proyectos.Clave_Fase')
                ->leftJoin('Enfoques', 'Enfoques.Clave', '=', 'Proyectos.Clave_Enfoque')
                ->leftJoin('Trabajos', 'Trabajos.Clave', '=', 'Proyectos.Clave_Trabajo')
                ->leftJoin('Indicador', 'Indicador.Clave', '=', 'Proyectos.Clave_Indicador')
                ->select('Proyectos.Clave', 'Companias.Descripcion as Compania', 'Proyectos.Descripcion as Descripcion', 'Status.status as Status', 'Areas.Descripcion as Area', 'Fases.Descripcion as Fase', 'Enfoques.Descripcion AS Enfoque', 'Trabajos.Descripcion As Trabajo', 'Indicador.Descripcion As Indicador', 'Objectivo')
                ->where('Proyectos.Clave_Compania', '=', Auth::user()->Clave_Compania)
                ->get();

            $url = url()->previous();
            $url = basename($url);
            if ($url == 'Actividades') {
                $mensaje = 'Selecciona el proyecto en el cual registraras una actividad';
                return view('Admin.Proyectos.index', ['proyecto' => $proyecto, 'compania' => $compania, 'mensaje' => $mensaje, 'rol' => $rol]);
            } else {
                return view('Admin.Proyectos.index', ['proyecto' => $proyecto, 'compania' => $compania, 'rol' => $rol]);
            }
        }

        if (Auth::user()->Clave_Rol == 3) {
            $proyecto = DB::table('RolesProyectos')
                ->leftJoin('Proyectos', 'RolesProyectos.Clave_Proyecto', '=', 'Proyectos.Clave')
                ->leftJoin('Companias', 'Proyectos.Clave_Compania', '=', 'Companias.Clave')
                ->leftJoin('Status', 'Status.Clave', '=', 'Proyectos.Clave_Status')
                ->leftJoin('Areas', 'Areas.Clave', '=', 'Proyectos.Clave_Area')
                ->leftJoin('Fases', 'Fases.Clave', '=', 'Proyectos.Clave_Fase')
                ->leftJoin('Enfoques', 'Enfoques.Clave', '=', 'Proyectos.Clave_Enfoque')
                ->leftJoin('Trabajos', 'Trabajos.Clave', '=', 'Proyectos.Clave_Trabajo')
                ->leftJoin('Indicador', 'Indicador.Clave', '=', 'Proyectos.Clave_Indicador')
                ->select('Proyectos.Clave', 'Companias.Descripcion as Compania', 'Proyectos.Descripcion as Descripcion', 'Status.status as Status', 'Areas.Descripcion as Area', 'Fases.Descripcion as Fase', 'Enfoques.Descripcion AS Enfoque', 'Trabajos.Descripcion As Trabajo', 'Indicador.Descripcion As Indicador', 'Objectivo')
                ->where('RolesProyectos.Clave_Usuario', '=', Auth::user()->Clave)
                ->get();

            $url = url()->previous();
            $url = basename($url);
            if ($url == 'Actividades') {
                $mensaje = 'Selecciona el proyecto en el cual registraras una actividad';
                return view('Admin.Proyectos.index', ['proyecto' => $proyecto, 'compania' => $compania, 'mensaje' => $mensaje, 'rol' => $rol]);
            } else {
                return view('Admin.Proyectos.index', ['proyecto' => $proyecto, 'compania' => $compania, 'rol' => $rol]);
            }
        }
    }

    public function edit($id){

		if(Auth::user()->Clave_Rol==4){
			$proyecto=Proyecto::find($id);
			$compania=Compania::where('Clave','=',Auth::user()->Clave_Compania)->get();
			$area=Areas::where('Clave_Compania','=',Auth::user()->Clave_Compania)->get();
			$fase=Fase::all();
			$enfoque=Enfoque::all();
			$trabajo=Trabajo::all();
			$indicador=Indicador::all();
    		return view('Admin.Proyectos.edit', ['proyecto'=>$proyecto,'companias'=>$compania,'areas'=>$area,'fases'=>$fase,'enfoques'=>$enfoque,'trabajos'=>$trabajo,'indicadores'=>$indicador]);
		}
		else{
			return redirect('/');
		}
    }

    public function new(){
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
        $company=Compania::where('Clave', Auth::user()->Clave_Compania)->get();
	    $areas=Areas::where('Clave_Compania','=',Auth::user()->Clave_Compania)->get();
	    $fases=Fase::where('Clave_Compania','=',Auth::user()->Clave_Compania)->get();
	    $enfoques=Enfoque::where('Clave_Compania','=',Auth::user()->Clave_Compania)->get();
	    $trabajos=Trabajo::all();
	    $indicadores=Indicador::where('Clave_Compania','=',Auth::user()->Clave_Compania)->get();
        $estados=Status::where('Clave_Compania','=',Auth::user()->Clave_Compania)->get();
        $count = 0;
        return view('Admin.Proyectos.new',['company'=>$company,'areas'=>$areas,'fases'=>$fases,'enfoques'=>$enfoques,'trabajos'=>$trabajos,'indicadores'=>$indicadores,'estados'=>$estados, 'count'=>$count,'compania'=>$compania]);
	}

    public function store(Request $request){
        $user = new User;
        $company=$user->Clave_Compania=Auth::user()->Clave_Compania;

        $project = $request->validate([
            'descripcion' => ['required', 'string', 'max:150'],
            'objetivo' => ['required', 'string', 'max:150'],
            'area' => ['required'],
            'fase' => ['required'],
            'enfoque' => ['required'],
            'trabajo' => ['required'],
            'indicador' => ['required'],
            'estado' => ['required']
        ]);

        Proyecto::create([
            'Clave_Compania' => $company,
            'Descripcion' => $project['descripcion'],
            'Objectivo' => $project['objetivo'],
            'Clave_Area' => $project['area'],
            'Clave_Fase' => $project['fase'],
            'Clave_Enfoque' => $project['enfoque'],
            'Clave_Trabajo' => $project['trabajo'],
            'Clave_Indicador' => $project['indicador'],
            'Clave_Status' => $project['estado'],
            'Activo' => 1,
            'FechaCreacion' => Carbon::today()->toDateString()

        ]);
        return redirect('/Admin/Proyectos')->with('mensaje', "Nuevo proyecto agregado correctamente");
    }
    public function delete($id){
    	$proyecto = Proyecto::find($id);
    	$proyecto->delete();
        return redirect('/Admin/Proyectos')->with('mensajeAlert', "Proyecto eliminado correctamente");
    }
    public function update(Request $request){
    	$proyecto = Proyecto::find($request->clave);
    	$proyecto->Clave_Compania = Auth::user()->Clave_Compania;
		$proyecto->Descripcion = $request->descripcion;
		$proyecto->Clave_Area = $request->area;
		$proyecto->Clave_Fase = $request->fase;
		$proyecto->Clave_Enfoque = $request->enfoque;
		$proyecto->Clave_Trabajo = $request->trabajo;
		$proyecto->Clave_Indicador = $request->indicador;
		$proyecto->Objectivo = $request->objectivo;
    	$proyecto->Activo=true;
		$proyecto->save();
		return response()->json(['proyecto'=>$proyecto]);
    }
    public function ProyectByCompany($company){
    	$projects=Proyecto::where('Clave_Compania',$company)
        ->get();
        return response()->json(['proyectos'=>$projects]);
    }

    public function editStage($id) {
        $proyectoFase=Proyecto::where('Clave', $id)->get()->toArray();
        $proyectoFase = $proyectoFase[0];
        $OldFase=Fase::where('Clave', $proyectoFase['Clave_Fase'])->get()->toArray();
        $OldFase = $OldFase[0]['Clave'];
        $fases=Fase::where('Clave_Compania','=',Auth::user()->Clave_Compania)->get();
        $count = 0;
        return view('Admin.Proyectos.editStage', compact('fases', 'count', 'OldFase', 'proyectoFase'));
    }

    public function editStatus($id) {
        $proyectoEstado=Proyecto::where('Clave', $id)->get()->toArray();
        $proyectoEstado = $proyectoEstado[0];
        $OldEstado=Status::where('Clave', $proyectoEstado['Clave_Status'])->get()->toArray();
        $OldEstado = $OldEstado[0]['Clave'];
        $estados=Status::where('Clave_Compania','=',Auth::user()->Clave_Compania)->get();
        $count = 0;
        return view('Admin.Proyectos.editStatus', compact('estados', 'count', 'OldEstado', 'proyectoEstado'));
    }

    public function updateStage(Request $request, $Clave){
        $fase = $request->validate([
            'fase' => ['required']
        ]);
        Proyecto::where('Clave', $Clave)->update([
            'Clave_Fase' => $fase['fase']
        ]);
        return redirect('/Admin/Proyectos')->with('mensaje', "La fase del proyecto fue actualizada correctamente");
    }

    public function updateStatus(Request $request, $Clave){
        $status = $request->validate([
            'status' => ['required']
        ]);
        Proyecto::where('Clave', $Clave)->update([
            'Clave_Status' => $status['status']
        ]);
        return redirect('/Admin/Proyectos')->with('mensaje', "El estado del proyecto fue actualizado correctamente");
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $role = 3;
            $i = 0;
            $usersArray = array();
            $UserArea = DB::table('Usuarios')->where('Clave_Area', '=', $request->area)->get();
            $pluckUserArea = $UserArea->pluck('Clave');
            foreach ($pluckUserArea as $user){
                $users = DB::table('Usuarios')
                    ->where('Clave','=', $pluckUserArea[$i])
                    ->where('Clave_Rol', '=', $role)
                    ->get();
                foreach ($users as $user){
                    $usersArray[$user->Clave] = $user->Nombres;
                }
                $i++;
            }
            return response()->json($usersArray);
        }
    }
}
