<?php

namespace App\Http\Controllers;

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
        $status=Status::find($id);
        return view('Admin.Status.edit',['status'=>$status]);
    }

    public function new(){        
        return view('Admin.Status.new');
    }
    public function create(Request $request){
        $status = new Status;
        $status->Status = $request->status;
        $status->Activo=true;
        $status->save();
        return response()->json(['status'=>$status]);
    }
    public function delete($id){
        $status = Status::find($id);

        $status->delete();
        return response()->json(['error'=>false]);
    }
    public function update(Request $request){
        $status = Status::find($request->clave);
        $status->Status = $request->status;
        $status->Activo=true;
        $status->save();
        return response()->json(['status'=>$status]);
    }
}
