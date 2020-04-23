<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Fase;
use App\Compania;
class FasesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        if(Auth::user()->Clave_Rol==1 ){
            $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
            $fase=Fase::where('Activo', 1)
               ->orderBy('Orden', 'asc')
               ->get();
            return view('Admin.Fases.index',['fase'=>$fase,'compania'=>$compania]);
        }
        else{
            return redirect('/');
        }
    }
    public function edit($id){
        if(Auth::user()->Clave_Rol==1 ){
            $fase=Fase::find($id);
            return view('Admin.Fases.edit',['fase'=>$fase]);
        }
        else{
            return redirect('/');
        }
    }

    public function new(){        
        if(Auth::user()->Clave_Rol==1 ){
            return view('Admin.Fases.new');
        }
        else{
            return redirect('/');
        }
    }
    public function create(Request $request){        
        $fase = new Fase;
        $fase->Descripcion = $request->descripcion;
        $fase->Orden = $request->orden;
        $fase->Activo=true;
        $fase->save();
        return response()->json(['fase'=>$fase]);
    }
    public function delete($id){
        $fase = Fase::find($id);
        $fase->delete();
        return response()->json(['error'=>false]);
    }
    public function update(Request $request){
        $fase = Fase::find($request->clave);
        $fase->Descripcion = $request->descripcion;
        $fase->Orden = $request->orden;
        $fase->Activo=true;
        $fase->save();
        return response()->json(['fase'=>$fase]);
    }
}
