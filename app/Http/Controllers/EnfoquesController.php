<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Compania;
use App\Enfoque;
class EnfoquesController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        if(Auth::user()->Clave_Rol==1 ){
            $enfoque=Enfoque::all();
            $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
            return view('Admin.Enfoques.index',['enfoque'=>$enfoque,'compania'=>$compania]);
        }else{
            return redirect('/');
        }
    }
    public function edit($id){
        if(Auth::user()->Clave_Rol==1 ){
            $enfoque=Enfoque::find($id);
            return view('Admin.Enfoques.edit',['enfoque'=>$enfoque]);
        }
        else{
            return redirect('/');
        }
    }

    public function new(){ 
        if(Auth::user()->Clave_Rol==1 ){       
            return view('Admin.Enfoques.new');
        }
        else{
            return redirect('/');
        }
    }
    public function create(Request $request){
        $enfoque = new Enfoque;
        $enfoque->Descripcion = $request->descripcion;
        $enfoque->Activo=true;
        $enfoque->save();
        return response()->json(['enfoque'=>$enfoque]);
    }
    public function delete($id){
        $enfoque = Enfoque::find($id);
        $enfoque->delete();
        return response()->json(['error'=>false]);
    }
    public function update(Request $request){
        $enfoque = Enfoque::find($request->clave);
        $enfoque->Descripcion = $request->descripcion;
        $enfoque->Activo=true;
        $enfoque->save();
        return response()->json(['enfoque'=>$enfoque]);
    }
    
}
