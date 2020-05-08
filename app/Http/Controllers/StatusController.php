<?php

namespace App\Http\Controllers;

use App\Puesto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Compania;
use App\Status;
class StatusController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        if(Auth::user()->Clave_Rol==1 ){
            $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
            $status=Status::all();
            return view('Admin.Status.index',['status'=>$status,'compania'=>$compania]);
        }
        else{
            return redirect('/');
        }

    }
    public function edit($id){
        $status=Status::where('Clave', $id)->get()->toArray();
        $statusId = $status[0]['Clave'];
        $status = $status[0];
        return view('Admin.Status.edit', compact('status', 'statusId'));
    }

    public function new(){
        return view('Admin.Status.new');
    }
    public function store(Request $request){
        $status = $request->validate([
            'status' => ['required', 'string', 'max:150', 'unique:Status']
        ]);
        Status::create([
            'Status' => $status['status'],
            'Activo' => 1,
            'FechaCreacion' => Carbon::now()
        ]);
        return redirect('/Admin/Status')->with('mensaje', "Nuevo estado agregado correctamente");
    }

    public function prepare($id){
        $status=Status::where('Clave', $id)->get()->toArray();
        $status = $status[0];
        return view('Admin.Status.delete', compact('status'));
    }

    public function delete($id){
        $status = Status::find($id);
        $status->delete();
        return redirect('/Admin/Status')->with('mensajeAlert', "Estado eliminado correctamente");
    }
    public function update(Request $request, $Clave){
        $status = $request->validate([
            'status' => ['required', 'string', 'max:150', 'unique:Status']
        ]);
        Status::where('Clave', $Clave)->update([
            'Status' => $status['status'],
            'Activo' => 1,
            'FechaCreacion' => Carbon::now()
        ]);
        return redirect('/Admin/Status')->with('mensaje', "El estado fue editado correctamente");
    }
}
