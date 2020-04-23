<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Compania;
use App\Indicador;
class IndicadorController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        if(Auth::user()->Clave_Rol==1 ){
            $indicador=Indicador::all();
            $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
            return view('Admin.Indicador.index',['indicador'=>$indicador,'compania'=>$compania]);
        }
        else{
            return redirect('/');
        }
        
    }
    public function edit($id){
        if(Auth::user()->Clave_Rol==1 ){
            $indicador=Indicador::find($id);
            return view('Admin.Indicador.edit',['indicador'=>$indicador]);
        }
        else{
            return redirect('/');
        }
    }

    public function new(){
        if(Auth::user()->Clave_Rol==1 ){
            return view('Admin.Indicador.new');
        }else{
            return redirect('/');
        }
    }
    public function create(Request $request){        
        $indicador = new Indicador;        
        $indicador->Descripcion = $request->descripcion;
        $indicador->Activo=true;
        $indicador->save();
        return response()->json(['indicador'=>$indicador]);
    }
    public function delete($id){
        $indicador = Indicador::find($id);

        $indicador->delete();
        return response()->json(['error'=>false]);
    }
    public function update(Request $request){
        $indicador = Indicador::find($request->clave);
        $indicador->Descripcion = $request->descripcion;
        $indicador->Activo=true;
        $indicador->save();
        return response()->json(['indicador'=>$indicador]);
    }
}
