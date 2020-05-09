<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $enfoque=Enfoque::where('Clave', $id)->get()->toArray();
        $enfoqueId = $enfoque[0]['Clave'];
        $enfoque = $enfoque[0];
        return view('Admin.Enfoques.edit', compact('enfoque', 'enfoqueId'));
    }

    public function prepare($id){
        $enfoque=Enfoque::where('Clave', $id)->get()->toArray();
        $enfoque = $enfoque[0];
        return view('Admin.Enfoques.delete', compact('enfoque'));
    }

    public function new(){
        return view('Admin.Enfoques.new');
    }

    public function store(Request $request){
        $enfoque = $request->validate([
            'descripcion' => ['required', 'string', 'max:150', 'unique:Enfoques'],
        ]);
        Enfoque::create([
            'Descripcion' => $enfoque['descripcion'],
            'Activo' => 1,
            'FechaCreacion' => Carbon::now()
        ]);
        return redirect('/Admin/Enfoques')->with('mensaje', "Nuevo enfoque agregado correctamente");
    }
    public function delete($id){
        $enfoque = Enfoque::find($id);
        $enfoque->delete();
        return redirect('/Admin/Enfoques')->with('mensajeAlert', "Enfoque eliminado correctamente");
    }
    public function update(Request $request, $Clave){
        $enfoque = $request->validate([
            'descripcion' => ['required', 'string', 'max:150', 'unique:Enfoques'],
        ]);
        Enfoque::where('Clave', $Clave)->update([
            'Descripcion' => $enfoque['descripcion'],
            'Activo' => 1,
            'FechaCreacion' => Carbon::now()
        ]);
        return redirect('/Admin/Enfoques')->with('mensaje', "El enfoque fue editado correctamente");
    }

}
