<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\NuevaActividad;
use Illuminate\Support\Facades\Mail;
use App\Areas;
use App\Compania;
use App\Actividad;
use App\Fase;
use App\Proyecto;
use App\Status;
use App\Enfoque;
use App\Trabajo;
use App\Indicador;
use App\RolRASIC;
use App\RolProyecto;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    }

    public function selectCompany(Request $request)
    {
        $companias = Compania::all();
        $userCompany = Auth::user()->Clave_Compania;
        return view('Shared.SelectCompany', compact('companias', 'userCompany'));
    }
}
