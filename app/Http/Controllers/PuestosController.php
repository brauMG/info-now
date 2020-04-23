<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Puesto;
use App\Compania;
class PuestosController extends Controller
{
    //
    public function index(){
        
        if(Auth::user()->Clave_Rol==1 ||Auth::user()->Clave_Rol==2 ){
            $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
            $puesto=DB::table('Puestos')
            ->leftJoin('Companias', 'Puestos.Clave_Compania', '=', 'Companias.Clave')           
            ->select('Puestos.Clave','Companias.Descripcion as Compania','Puestos.Puesto','Puestos.FechaCreacion','Puestos.Activo') 
            ->where('Puestos.Clave_Compania','=',Auth::user()->Clave_Compania)           
            ->get();
            return view('Admin.Puestos.index',['puesto'=>$puesto,'compania'=>$compania]);
        }
        else{
            return redirect('/');
        }
    }
    public function edit($id){
        $puesto=Puesto::find($id);
        if(Auth::user()->Clave_Rol==1 ||Auth::user()->Clave_Rol==2){
            $company=Compania::where('Clave', Auth::user()->Clave_Compania)
            ->get();
            return view('Admin.Puestos.edit',['company'=>$company,'puesto'=>$puesto]);
        }
        else{
            return redirect('/');
        }
        
    }

    public function new(){
        if(Auth::user()->Clave_Rol==1 ||Auth::user()->Clave_Rol==2){
            $company=Compania::where('Clave', Auth::user()->Clave_Compania)
            ->get();
            return view('Admin.Puestos.new',['company'=>$company]);
        }
        else{
            return redirect('/');
        }
    }
    public function create(Request $request){
        $puesto = new Puesto;
        $puesto->Clave_Compania = Auth::user()->Clave_Compania;
        $puesto->Puesto = $request->puesto;
        $puesto->Activo=true;
        $puesto->save();
        return response()->json(['puesto'=>$puesto]);
    }
    public function delete($id){
        $puesto = Puesto::find($id);

        $puesto->delete();
        return response()->json(['error'=>false]);
    }
    public function update(Request $request){
        $puesto = Puesto::find($request->clave);
        $puesto->Clave_Compania = Auth::user()->Clave_Compania;
        $puesto->Puesto = $request->puesto;
        $puesto->Activo=true;
        $puesto->save();
        return response()->json(['puesto'=>$puesto]);
    }
}
