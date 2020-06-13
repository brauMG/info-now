<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombres' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:Usuarios'],
            'compania'=>['required', 'int'],
            'area' => ['required', 'int'],
            'puesto' => ['required', 'int'],
            'rol' => ['required', 'int'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $name = explode(" ", $data['Nombres']);
        return User::create([
            //'Clave_Compania','Iniciales','email','Clave_Area',	'Clave_Puesto',	'Clave_Rol','UltimoLogin','FechaCreacion','Activo',password
            'Clave_Compania'=>$data['compania'],
            'Iniciales'=>$data['nombres'][0],
            'Nombres' => $data['nombres'],
            'email' => $data['correo'],
            'Clave_Area'=>$data['area'],
            'Clave_Puesto'=>$data['puesto'],
            'Clave_Rol'=>$data['rol'],
            'password' => Hash::make($data['contrasena']),
        ]);
    }
}
