<?php

namespace App\Http\Controllers;
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
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        //dd( Auth::user());
         $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
        $actividad=DB::table('Actividades')
        ->leftJoin('Companias', 'Actividades.Clave_Compania', '=', 'Companias.Clave')
        ->leftJoin('Proyectos','Actividades.Clave_Proyecto','=','Proyectos.Clave')
        ->leftJoin('Fases','Actividades.Clave_Fase','=','Fases.Clave')
        ->leftJoin('Status','Actividades.Clave_Status','=','Status.Clave')
        //->leftJoin('RolesProyectos','Actividades.Clave_Proyecto','=','RolesProyectos.Clave_Proyecto')
        ->select('Actividades.Clave','Companias.Descripcion as Compania','Proyectos.Descripcion as Proyecto','Fases.Descripcion as Fase','Actividades.Descripcion','Actividades.FechaAccion','Actividades.Decision','Status.Status as Status','Actividades.FechaCreacion','Actividades.Activo')
        //->where([
           // ['RolesProyectos.Clave_Usuario','=',Auth::user()->Clave],
          //  ['RolesProyectos.Clave_Rol_RASIC','=','R']
        //])
        ->get();
        return view('Admin.Actividades.index',['actividad'=>$actividad,'compania'=>$compania]);
    }
    public function edit($id){
        $actividad=Actividad::find($id);
        $compania=Compania::all();
        $proyectos=Proyecto::all();
        $fases=Fase::all();
        $status=Status::all();
        return view('Admin.Actividades.edit',['actividad'=>$actividad,'proyectos'=>$proyectos,'compania'=>$compania,'fases'=>$fases,'status'=>$status]);
    }

    public function new(){        
        $compania=Compania::all();
        $proyectos=Proyecto::all();
        $fases=Fase::all();
        $status=Status::all();
        return view('Admin.Actividades.new',['proyectos'=>$proyectos,'compania'=>$compania,'fases'=>$fases,'status'=>$status]);
    }
    public function create(Request $request){        
        
        $actividad = new Actividad;        
        $actividad->Clave_Compania=$request->compania;
        $actividad->Clave_Proyecto = $request->proyecto;
        $actividad->Clave_Fase = $request->fase;
        $actividad->Descripcion = $request->descripcion;
        $actividad->FechaAccion = $request->fechaAccion;
        $actividad->Decision = $request->decision;
        $actividad->Clave_Status = $request->status;
        $actividad->Activo=true;
        $actividad->save();
        return response()->json(['actividad'=>$actividad]);
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
}
