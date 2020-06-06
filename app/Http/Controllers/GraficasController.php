<?php


namespace App\Http\Controllers;


use App\Charts\ProjectFocusChart;
use App\Compania;
use App\Fase;
use App\Proyecto;
use App\Trabajo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GraficasController extends Controller
{
    public function toProjects() {

        //PROYECTOS POR ENFOQUE
        $ProyectosEnfoque = DB::table('Proyectos')
            ->leftJoin('Enfoques', 'Proyectos.Clave_Enfoque', 'Enfoques.Clave')
            ->select('Proyectos.Descripcion as Proyecto', 'Enfoques.Descripcion as Enfoque')
            ->get();
        $peCalidad = DB::table('Proyectos')
            ->leftJoin('Enfoques', 'Proyectos.Clave_Enfoque', 'Enfoques.Clave')
            ->select('Proyectos.Descripcion as Proyecto')
            ->where('Enfoques.Clave', 1)
            ->get();
        $peGente = DB::table('Proyectos')
            ->leftJoin('Enfoques', 'Proyectos.Clave_Enfoque', 'Enfoques.Clave')
            ->select('Proyectos.Descripcion as Proyecto')
            ->where('Enfoques.Clave', 2)
            ->get();
        $peCosto = DB::table('Proyectos')
            ->leftJoin('Enfoques', 'Proyectos.Clave_Enfoque', 'Enfoques.Clave')
            ->select('Proyectos.Descripcion as Proyecto')
            ->where('Enfoques.Clave', 3)
            ->get();
        $peServicio = DB::table('Proyectos')
            ->leftJoin('Enfoques', 'Proyectos.Clave_Enfoque', 'Enfoques.Clave')
            ->select('Proyectos.Descripcion as Proyecto')
            ->where('Enfoques.Clave', 4)
            ->get();
        $peCrecimiento = DB::table('Proyectos')
            ->leftJoin('Enfoques', 'Proyectos.Clave_Enfoque', 'Enfoques.Clave')
            ->select('Proyectos.Descripcion as Proyecto')
            ->where('Enfoques.Clave', 5)
            ->get();

        $peCalidad = count($peCalidad);
        $peGente = count($peGente);
        $peCosto = count($peCosto);
        $peServicio = count($peServicio);
        $peCrecimiento = count($peCrecimiento);

        //PROYECTOS POR TRABAJO
        $ProyectosTrabajo = DB::table('Proyectos')
            ->leftJoin('Trabajos', 'Proyectos.Clave_Trabajo', 'Trabajos.Clave')
            ->select('Proyectos.Descripcion as Proyecto', 'Trabajos.Descripcion as Trabajo')
            ->get();
        $ptOperaciones = DB::table('Proyectos')
            ->leftJoin('Trabajos', 'Proyectos.Clave_Trabajo', 'Trabajos.Clave')
            ->select('Proyectos.Descripcion as Proyecto')
            ->where('Trabajos.Clave', 1)
            ->get();
        $ptAdministrativo = DB::table('Proyectos')
            ->leftJoin('Trabajos', 'Proyectos.Clave_Trabajo', 'Trabajos.Clave')
            ->select('Proyectos.Descripcion as Proyecto')
            ->where('Trabajos.Clave', 2)
            ->get();
        $ptProyectos = DB::table('Proyectos')
            ->leftJoin('Trabajos', 'Proyectos.Clave_Trabajo', 'Trabajos.Clave')
            ->select('Proyectos.Descripcion as Proyecto')
            ->where('Trabajos.Clave', 3)
            ->get();
        $ptIniciativas = DB::table('Proyectos')
            ->leftJoin('Trabajos', 'Proyectos.Clave_Trabajo', 'Trabajos.Clave')
            ->select('Proyectos.Descripcion as Proyecto')
            ->where('Trabajos.Clave', 4)
            ->get();

        $ptOperaciones = count($ptOperaciones);
        $ptAdministrativo = count($ptAdministrativo);
        $ptProyectos = count($ptProyectos);
        $ptIniciativas = count($ptIniciativas);

        //PROYECTOS POR FASE
        $ProyectosFase = DB::table('Proyectos')
            ->leftJoin('Fases', 'Proyectos.Clave_Fase', 'Fases.Clave')
            ->select('Proyectos.Descripcion as Proyecto', 'Fases.Descripcion as Fase', 'Proyectos.Clave_Fase')
            ->get();

        $fases = Fase::where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $fases = $fases->unique('Descripcion');
        $conteoFases = count($fases);
        $dataFases = [];

        for ($i = 0; $i <= $conteoFases; $i++) {
            $dataFases [] = [$i];
        }

        dd($dataFases);

        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();

        return view('Admin.Graficas.proyectos', compact('ProyectosEnfoque','ProyectosTrabajo','ProyectosFase', 'compania', 'peCrecimiento', 'peCalidad', 'peGente', 'peServicio', 'peCosto', 'ptOperaciones', 'ptAdministrativo', 'ptProyectos', 'ptIniciativas', 'fases'));
    }

    public function toActivities() {
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
        return view('Admin.Graficas.actividades', ['compania' => $compania]);
    }
}
