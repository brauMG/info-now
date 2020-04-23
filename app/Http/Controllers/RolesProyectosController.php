<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Compania;
use App\RolProyecto;
use App\Fase;
use App\Proyecto;
use App\RolRASIC;
use App\User;

class RolesProyectosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
     public function index(){                
        if(Auth::user()->Clave_Rol==4)
        {
            $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
            $rolPROYECTO=DB::table('RolesProyectos')
            ->leftJoin('Proyectos', 'RolesProyectos.Clave_Proyecto', '=', 'Proyectos.Clave')            
            ->leftJoin('Fases', 'RolesProyectos.Clave_Fase', '=', 'Fases.Clave')
            ->leftJoin('RolesRASIC', 'RolesProyectos.Clave_Rol_RASIC', '=', 'RolesRASIC.Clave')
            ->leftJoin('Usuarios', 'RolesProyectos.Clave_Usuario', '=', 'Usuarios.Clave')
            ->select('RolesProyectos.Clave as Clave','Proyectos.Descripcion as Proyecto','Usuarios.Nombres as Usuario','Fases.Descripcion as Fase','RolesRASIC.RolRASIC as RolRASIC')
            ->where('Proyectos.Clave_Compania','=',Auth::user()->Clave_Compania)
            ->get();
            return view('Admin.RolesProyectos.index',['rolPROYECTO'=>$rolPROYECTO,'compania'=>$compania]);    
        }        
        else{
            return redirect('/');
        }
        
    }
    public function edit($id){        
        if(Auth::user()->Clave_Rol==4)
        {
            $fases=Fase::where('Activo',1)->orderBy('Orden')->get();
            $rolRASIC=RolRASIC::all();
            $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();        
            $rolPROYECTO=RolProyecto::find($id);            
            $proyecto=Proyecto::where('Clave_Compania','=',Auth::user()->Clave_Compania)->get();
            $usuario=User::where('Clave_Compania','=',Auth::user()->Clave_Compania)->get();
            return view('Admin.RolesProyectos.edit',['rolPROYECTO'=>$rolPROYECTO,'proyectos'=>$proyecto,'fases'=>$fases,'rolesRASIC'=>$rolRASIC,'usuarios'=>$usuario,'compania'=>$compania]);
        }
        else{
            return redirect('/');
        }
    }

    public function new(){        
        if(Auth::user()->Clave_Rol==4)
        {
            $fases=Fase::where('Activo',1)->orderBy('Orden')->get();
            $rolRASIC=RolRASIC::all();
            $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();        
            $proyecto=Proyecto::where('Clave_Compania','=',Auth::user()->Clave_Compania)->get();
            $usuario=User::where('Clave_Compania','=',Auth::user()->Clave_Compania)->get();
            return view('Admin.RolesProyectos.new',['proyectos'=>$proyecto,'fases'=>$fases,'rolesRASIC'=>$rolRASIC,'usuarios'=>$usuario,'compania'=>$compania]);
        }
        else{
            return redirect('/');
        }
    }
    public function create(Request $request){
        //proyecto:proyecto,rolRASIC:rolRASIC,usuario:usuario
        $rolPROYECTO = new RolProyecto;
        $rolPROYECTO->Clave_Proyecto = $request->proyecto;
        $rolPROYECTO->Clave_Fase = $request->fase;
        $rolPROYECTO->Clave_Rol_RASIC = $request->rolRASIC;
        $rolPROYECTO->Clave_Usuario=$request->usuario;
        $rolPROYECTO->Activo=true;
        $rolPROYECTO->save();
        return response()->json(['rolPROYECTO'=>$rolPROYECTO]);
    }
    public function delete($id){
        $rolPROYECTO = RolProyecto::find($id);
        $rolPROYECTO->delete();
        return response()->json(['error'=>false]);
    }
    public function update(Request $request){
        $rolPROYECTO = RolProyecto::find($request->clave);
        $rolPROYECTO->Clave_Proyecto = $request->proyecto;
        $rolPROYECTO->Clave_Fase = $request->fase;
        $rolPROYECTO->Clave_Rol_RASIC = $request->rolRASIC;
        $rolPROYECTO->Clave_Usuario=$request->usuario;
        $rolPROYECTO->Activo=true;
        $rolPROYECTO->save();
        return response()->json(['rolPROYECTO'=>$rolPROYECTO]);
    }  
}
