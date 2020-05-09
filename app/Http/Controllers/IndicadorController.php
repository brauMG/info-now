<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
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
        $indicador=Indicador::where('Clave', $id)->get()->toArray();
        $indicadorId = $indicador[0]['Clave'];
        $indicador = $indicador[0];
        return view('Admin.Indicador.edit', compact('indicador', 'indicadorId'));
    }

    public function new(){
        return view('Admin.Indicador.new');
    }

    public function store(Request $request){
        $indicador = $request->validate([
            'descripcion' => ['required', 'string', 'max:150', 'unique:Indicador'],
        ]);
        Indicador::create([
            'Descripcion' => $indicador['descripcion'],
            'Activo' => 1,
            'FechaCreacion' => Carbon::now()
        ]);
        return redirect('/Admin/Indicador')->with('mensaje', "Nuevo indicador agregado correctamente");
    }

    public function prepare($id){
        $indicador=Indicador::where('Clave', $id)->get()->toArray();
        $indicador = $indicador[0];
        return view('Admin.Indicador.delete', compact('indicador'));
    }
    public function delete($id){
        $indicador = Indicador::find($id);
        $indicador->delete();
        return redirect('/Admin/Indicador')->with('mensajeAlert', "Indicador eliminado correctamente");
    }

    public function update(Request $request, $Clave){
        $indicador = $request->validate([
            'descripcion' => ['required', 'string', 'max:150', 'unique:Indicador'],
        ]);
        Indicador::where('Clave', $Clave)->update([
            'Descripcion' => $indicador['descripcion'],
            'Activo' => 1,
            'FechaCreacion' => Carbon::now()
        ]);
        return redirect('/Admin/Indicador')->with('mensaje', "El indicador fue editado correctamente");
    }
}
