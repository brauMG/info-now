<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Compania;
use Illuminate\Support\Facades\Redirect;

class CompaniaController extends Controller
{
    //
    public function __construct(){
        $this->middleware(['auth', 'verified']);
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
        $company=Compania::where('Clave', $id)->get()->toArray();
        $company = $company[0];
        return view('Admin.Compania.edit', compact('company'));
    }

    public function prepare($id){
        $company=Compania::where('Clave', $id)->get()->toArray();
        $company = $company[0];
        return view('Admin.Compania.delete', compact('company'));
    }

    public function new(){
        return view('Admin.Compania.new');
    }
    public function store(Request $request){
        $company = $request->validate([
           'descripcion' => ['required', 'string', 'max:150', 'unique:Companias'],
           'dominio' => ['required', 'string', 'max:50', 'min:4']
        ]);
        Compania::create([
            'Descripcion' => $company['descripcion'],
            'Dominio' => $company['dominio'],
            'Activo' => 1,
            'FechaCreacion' => Carbon::today()->toDateString()
        ]);
        return redirect('/Admin/Compania')->with('mensaje', "Nueva compañia agregada correctamente");
    }
    public function delete($id){
        $companies = Compania::all();
        $companies = count($companies);
        if ($companies == 1) {
            return redirect('/Admin/Compania')->with('mensajeDanger', "No es posible eliminar todas las compañias.");
        }
        else {
            $company = Compania::find($id);
            $company->delete();
            return redirect('/Admin/Compania')->with('mensajeAlert', "Compañia eliminada correctamente");
        }
    }
    public function update(Request $request, $Clave){
        $company = $request->validate([
            'descripcion' => ['required', 'string', 'max:150', 'unique:Companias'],
            'dominio' => ['required', 'string', 'max:50', 'min:4']
        ]);
        Compania::where('Clave', $Clave)->update([
            'Descripcion' => $company['descripcion'],
            'Dominio' => $company['dominio'],
            'Activo' => 1,
            'FechaCreacion' => Carbon::today()->toDateString()
        ]);
        return redirect('/Admin/Compania')->with('mensaje', "Compañia editada correctamente");
    }
}
