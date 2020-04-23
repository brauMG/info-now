<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Areas;
use App\Compania;
use Excel;
use App\Rol;
use App\Puesto;
use App\User;
class UsuariosController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
        if(Auth::user()->Clave_Rol==1||Auth::user()->Clave_Rol==2){            
            $Usuarios=DB::table('Usuarios')
            ->leftJoin('Companias', 'Usuarios.Clave_Compania', '=', 'Companias.Clave')
            ->leftJoin('Areas','Usuarios.Clave_Area','=','Areas.Clave')
            ->leftJoin('Puestos','Usuarios.Clave_Puesto','=','Puestos.Clave')
            ->leftJoin('Roles','Usuarios.Clave_Rol','=','Roles.Clave')
            ->select('Usuarios.Clave','Companias.Descripcion as Compania','Usuarios.Iniciales','Usuarios.Nombres','Usuarios.Correo','Areas.Descripcion as Area','Puestos.Puesto as Puesto','Roles.Rol AS Rol','Usuarios.Nombres','Usuarios.UltimoLogin as UltimoLogin','Areas.FechaCreacion','Areas.Activo')
            ->where('Usuarios.Clave_Compania','=',Auth::user()->Clave_Compania)
            ->where('Usuarios.Clave','<>',Auth::user()->Clave)
            ->get();
            return view('Admin.Usuarios.index',['usuarios'=>$Usuarios,'compania'=>$compania]);
        }else{
            return redirect('/');
        }        
    }
    public function edit($id){
        $user=User::find($id);
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
        if(Auth::user()->Clave_Rol==1)
        {
            $area=Areas::where('Clave_Compania',Auth::user()->Clave_Compania)->get();
            $company=Compania::where('Clave',Auth::user()->Clave_Compania)->get();
            $rol=Rol::all();
            $puesto=Puesto::where('Clave_Compania',Auth::user()->Clave_Compania)->get();
            return view('Admin.Usuarios.edit',['usuario'=>$user,'company'=>$company,'area'=>$area,'rol'=>$rol,'puesto'=>$puesto,'compania'=>$compania]);
        }
        else if(Auth::user()->Clave_Rol==2){
            $area=Areas::where('Clave_Compania',Auth::user()->Clave_Compania)->get();
            $company=Compania::where('Clave',Auth::user()->Clave_Compania)->get();
            $rol=Rol::where('Clave','<>','1')->where('Clave','<>','2')->get();
            $puesto=Puesto::where('Clave_Compania',Auth::user()->Clave_Compania)->get();
            return view('Admin.Usuarios.edit',['usuario'=>$user,'company'=>$company,'area'=>$area,'rol'=>$rol,'puesto'=>$puesto,'compania'=>$compania]);
        }
        else{
            return redirect('/');
        }
    }
    public function changePassword($id){
        $user=User::find($id);
        return view('Admin.Usuarios.password',['usuario'=>$user]);
    }
    public function new(){
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
        $area=Areas::where('Clave_Compania',Auth::user()->Clave_Compania)->get();
        $company=Compania::where('Clave',Auth::user()->Clave_Compania)->get();
        $puesto=Puesto::where('Clave_Compania',Auth::user()->Clave_Compania)->get();
        if(Auth::user()->Clave_Rol==1 )
        {            
            $rol=Rol::all();            
            return view('Admin.Usuarios.new',['company'=>$company,'area'=>$area,'rol'=>$rol,'puesto'=>$puesto,'compania'=>$compania]);
        }
        else if(Auth::user()->Clave_Rol==2)
        {            
            $rol=Rol::where('Clave','<>','1')->where('Clave','<>','2')->get();            
            return view('Admin.Usuarios.new',['company'=>$company,'area'=>$area,'rol'=>$rol,'puesto'=>$puesto,'compania'=>$compania]);
        }
        else{
            return redirect('/');
        }
    }

    public function ImportExcelIndex(){
        return view('Admin.Usuarios.ImportExcelIndex');
    }

    public function importData(Request $request){
        $request->validate([
            'import_file' => 'required'
        ]);
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();
        if($data->count()){
            foreach ($data as $key=>$value) {
                try {
                    $user = new User;
                    $user->Clave_Compania=$value->clave_compania;
                    $user->Iniciales=$value->iniciales;
                    $user->Nombres=$value->nombres;
                    $user->Correo=$value->correo;
                    $user->Clave_Area=$value->clave_area;
                    $user->Clave_Puesto=$value->clave_puesto;
                    $user->Clave_Rol=$value->clave_rol;        
                    $user->Contrasena= Hash::make($value->contrasena);
                    $user->Activo=true;             
                    $user->save();   
                } catch (Exception $e) {
                    dd($e);
                }
                           
            }
        }
     return redirect('/Admin/Usuarios');
    }

    public function create(Request $request){        
        $user = new User;
        $user->Clave_Compania=Auth::user()->Clave_Compania;
        $user->Iniciales=$request->nombres[0];
        $user->Nombres=$request->nombres;
        $user->Correo=$request->correo;
        $user->Clave_Area=$request->area;
        $user->Clave_Puesto=$request->puesto;
        $user->Clave_Rol=$request->rol;        
        $user->Contrasena= Hash::make($request->contrasena);
        $user->Activo=true;
        $user->save();
        return response()->json(['user'=>$user]);
    }
    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return response()->json(['error'=>false]);
    }
    public function update(Request $request){
        $user = User::find($request->clave);        
        $user->Clave_Compania=Auth::user()->Clave_Compania;
        $user->Iniciales=$request->nombres[0];
        $user->Nombres=$request->nombres;
        $user->Correo=$request->correo;
        $user->Clave_Area=$request->area;
        $user->Clave_Puesto=$request->puesto;
        $user->Clave_Rol=$request->rol;
        $user->Activo=true;
        $user->save();        
        return response()->json(['usuario'=>$user]);
    }

    public function updatePassword(Request $request){
        $user = User::find($request->clave);
        $user->Contrasena= Hash::make($request->contrasena);        
        $user->save();
        return response()->json(['usuario'=>$user]);
    }
    public function UsersByProyect($proyecto){
        $usuarios=DB::table('Usuarios')
        ->leftJoin('RolesProyectos','RolesProyectos.Clave_Usuario','=','Usuarios.Clave')
        ->where('RolesProyectos.Clave_Proyecto','=',$proyecto)
        ->get();
        return response()->json(['usuarios'=>$usuarios]);
    }

    public function UpdatesUsersByCompany(){
        
    }

    public function changeCompany($id){
        $user = User::find(Auth::user()->Clave);
        $user->Clave_Compania=$id;
        $user->save();
        Auth::user()->fresh();
        return response()->json(['error'=>false]);
    }

}
