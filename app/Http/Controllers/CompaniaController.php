<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Compania;
class CompaniaController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        if(Auth::user()->Clave_Rol==1 ){
            $company=Compania::all();
            $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
            return view('Admin.Compania.index',['company'=>$company,'compania'=>$compania]);    
        }
        else{
            return redirect('/');
        }
    }
    public function edit($id){
        
        $company=Compania::find($id);
        return view('Admin.Compania.edit',['company'=>$company]);
    }

    public function new(){        
        return view('Admin.Compania.new');
    }
    public function create(Request $request){
        $company = new Compania;
        $company->Descripcion = $request->descripcion;
        $company->Dominio = $request->dominio;
        $company->Activo=true;
        $company->save();
        return response()->json(['company'=>$company]);
    }
    public function delete($id){
        $company = Compania::find($id);
        $company->delete();
        return response()->json(['error'=>false]);
    }
    public function update(Request $request){
        $company = Compania::find($request->clave);
        $company->Descripcion = $request->descripcion;
        $company->Dominio = $request->dominio;
        $company->Activo=true;
        $company->save();
        return response()->json(['company'=>$company]);
    }    
}
