<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Areas;
use App\Compania;
class AreaController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){             
        if( Auth::user()->Clave_Rol==1 ||Auth::user()->Clave_Rol==2 ){
            $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
            $area=DB::table('Areas')
            ->leftJoin('Companias', 'Areas.Clave_Compania', '=', 'Companias.Clave')
            ->where('Companias.Clave','=',Auth::user()->Clave_Compania)
            ->select('Areas.Clave','Companias.Descripcion as Compania','Areas.Descripcion','Areas.FechaCreacion','Areas.Activo')
            ->get();
            return view('Admin.Areas.index',['area'=>$area,'compania'=>$compania]);
        }
        else{
            return redirect('/');
        }
    }
    public function edit($id){        
        if(Auth::user()->Clave_Rol==1 ||Auth::user()->Clave_Rol==2){
            $area=Areas::find($id);
            $company=Compania::where('Clave', Auth::user()->Clave_Compania)
            ->get();
            return view('Admin.Areas.edit',['area'=>$area,'company'=>$company]);
        }
        else{
            return redirect('/'); 
        }
    }

    public function new(){        
        if(Auth::user()->Clave_Rol==1 ||Auth::user()->Clave_Rol==2)
        {
            $company=Compania::where('Clave', Auth::user()->Clave_Compania)
            ->get();
            return view('Admin.Areas.new',['company'=>$company]);
        }
        else{
            return redirect('/'); 
        }
        
    }
    public function create(Request $request){        
        $area = new Areas;
        $area->Clave_Compania=Auth::user()->Clave_Compania;
        $area->Descripcion = $request->descripcion;
        $area->Activo=true;
        $area->save();
        return response()->json(['area'=>$area]);
    }
    public function delete($id){
        $area = Areas::find($id);

        $area->delete();
        return response()->json(['error'=>false]);
    }
    public function update(Request $request){
        $area = Areas::find($request->clave);
        $area->Clave_Compania=Auth::user()->Clave_Compania;
        $area->Descripcion = $request->descripcion;
        $area->Activo=true;
        $area->save();
        return response()->json(['area'=>$area]);
    }
}
