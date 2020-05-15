<?php

namespace App\Http\Controllers\Auth;

use App\Compania;
use App\Rol;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'correo';
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }
    protected function authenticated(Request $request, $user)
    {
        $now = new DateTime();
        $user->UltimoLogin = $now;
        $user->save();

        if ($user->Clave_Rol == 1) {
            return redirect('/Admin/Compania');
        } elseif ($user->Clave_Rol == 2) {
            return redirect('/Admin/Areas');
        } elseif ($user->Clave_Rol == 3) {
            return redirect('/Admin/MisProyectos');
        } elseif ($user->Clave_Rol == 4) {
            return redirect('/Admin/Proyectos');
        } else {
            return redirect('/login');
        }
    }
}
