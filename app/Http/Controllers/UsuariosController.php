<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $userRol = Auth::user()->Clave_Rol;
        $usuario=User::where('Clave', $id)->get()->toArray();
        $userId = $usuario[0]['Clave'];
        $usuario = $usuario[0];
        $usuarioArea = $usuario['Clave_Area'];
        $usuarioRol = $usuario['Clave_Rol'];
        $usuarioPuesto = $usuario['Clave_Puesto'];
        $area=Areas::where('Clave_Compania',Auth::user()->Clave_Compania)->get();
        $rol=Rol::all();
        $puesto=Puesto::where('Clave_Compania',Auth::user()->Clave_Compania)->get();
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->get();
        return view('Admin.Usuarios.edit', compact('userRol','usuario', 'userId', 'area', 'rol', 'puesto', 'compania', 'usuarioArea', 'usuarioRol', 'usuarioPuesto'));
    }

    public function new(){
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
        $area=Areas::where('Clave_Compania',Auth::user()->Clave_Compania)->get();
        $puesto=Puesto::where('Clave_Compania',Auth::user()->Clave_Compania)->get();
        $rol=Rol::all();
        return view('Admin.Usuarios.new', compact('compania', 'puesto', 'area', 'rol'));
    }

    public function store(Request $request){
        $user = new User;
        $company=$user->Clave_Compania=Auth::user()->Clave_Compania;

        $user = $request->validate([
            'nombres' => ['required', 'string', 'max:150'],
            'correo' => ['required', 'email', 'max:50', 'unique:Usuarios'],
            'area' => ['required'],
            'puesto' => ['required'],
            'rol' => ['required'],
            'password' => ['required', 'string', 'min:8', 'max:250', 'confirmed']
        ]);
        $nombres = explode(" ", $request->input('nombres'));
        $iniciales = "";

        foreach ($nombres as $l){
            $iniciales .=$l[0];
        }
        User::create([
            'Clave_Compania' => $company,
            'Iniciales' => $iniciales,
            'Nombres' => $user['nombres'],
            'Correo' => $user['correo'],
            'Clave_Area' => $user['area'],
            'Clave_Puesto' => $user['puesto'],
            'Clave_Rol' => $user['rol'],
            'Contrasena' => Hash::make($user['password']),
            'UltimoLogin' => Carbon::today()->toDateString(),
            'Activo' => 1,
            'FechaCreacion' => Carbon::today()->toDateString()

        ]);
        return redirect('/Admin/Usuarios')->with('mensaje', "Nuevo usuario agregado correctamente");
    }

    public function prepare($id){
        $user=User::where('Clave', $id)->get()->toArray();
        $user = $user[0];
        return view('Admin.Usuarios.delete', compact('user'));
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return redirect('/Admin/Usuarios')->with('mensajeAlert', "Usuario eliminado correctamente");
    }
    public function update(Request $request, $Clave){
        $user = new User;
        $company=$user->Clave_Compania=Auth::user()->Clave_Compania;
        $user = User::where('Clave', $Clave)->firstOrFail();
        $email = $request->input('correo');
        $name = $request->input('nombres');

        if ($email == $user->Correo) {
            if ($name == $user->Nombres) {
                $user = $request->validate([
                    'area' => ['required'],
                    'puesto' => ['required'],
                    'rol' => ['required']
                ]);

                User::where('Clave', $Clave)->update([
                    'Clave_Area' => $user['area'],
                    'Clave_Puesto' => $user['puesto'],
                    'Clave_Rol' => $user['rol'],
                ]);
            }
            else {
                $user = $request->validate([
                    'nombres' => ['required', 'max:150', 'string', 'unique:Usuarios'],
                    'area' => ['required'],
                    'puesto' => ['required'],
                    'rol' => ['required']
                ]);

                $nombres = explode(" ", $request->input('nombres'));
                $iniciales = "";

                foreach ($nombres as $l) {
                    $iniciales .= $l[0];
                }
                User::where('Clave', $Clave)->update([
                    'Iniciales' => $iniciales,
                    'Nombres' => $user['nombres'],
                    'Clave_Area' => $user['area'],
                    'Clave_Puesto' => $user['puesto'],
                    'Clave_Rol' => $user['rol'],
                ]);
            }
        }
        else if ($name = $user->Nombres){
            $user = $request->validate([
                'correo' => ['required', 'max:150', 'email', 'unique:Usuarios'],
                'area' => ['required'],
                'puesto' => ['required'],
                'rol' => ['required']
            ]);

            User::where('Clave', $Clave)->update([
                'Correo' => $user['correo'],
                'Clave_Area' => $user['area'],
                'Clave_Puesto' => $user['puesto'],
                'Clave_Rol' => $user['rol'],
            ]);
        }
        else {
            $nombres = explode(" ", $request->input('nombres'));
            $iniciales = "";

            foreach ($nombres as $l) {
                $iniciales .= $l[0];
            }
            User::where('Clave', $Clave)->update([
                'Iniciales' => $iniciales,
                'Nombres' => $user['nombres'],
                'Correo' => $user['correo'],
                'Clave_Area' => $user['area'],
                'Clave_Puesto' => $user['puesto'],
                'Clave_Rol' => $user['rol'],
            ]);
        }

        return redirect('/Admin/Usuarios')->with('mensaje', "El usuario fue editado correctamente");
    }

    public function changeCompany($id){
        $user = User::find(Auth::user()->Clave);
        $user->Clave_Compania=$id;
        $user->save();
        Auth::user()->fresh();
        return back();
    }
}
