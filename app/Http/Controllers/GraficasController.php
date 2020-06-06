<?php


namespace App\Http\Controllers;


use App\Areas;
use App\Charts\ProjectFocusChart;
use App\Compania;
use App\Fase;
use App\Indicador;
use App\Proyecto;
use App\Status;
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
        $dataFases = [];

        $i = 1;
        foreach ($fases as $fase) {
            foreach ($ProyectosFase as $proyecto) {
                if ($proyecto->Clave_Fase == $fase->Clave) {
                    $dataFases [$fase->Descripcion] = $i;
                    $i++;
                }
            }
            $i = 1;
        }

        $fases = array_keys($dataFases);
        $conteoFases = array_values($dataFases);

        //PROYECTOS POR INDICADOR
        $ProyectosIndicador = DB::table('Proyectos')
            ->leftJoin('Indicador', 'Proyectos.Clave_Indicador', 'Indicador.Clave')
            ->select('Proyectos.Descripcion as Proyecto', 'Indicador.Descripcion as Indicador', 'Proyectos.Clave_Indicador')
            ->get();

        $indicadores = Indicador::where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $indicadores = $indicadores->unique('Descripcion');
        $dataIndicadores = [];

        $i = 1;
        foreach ($indicadores as $indicador) {
            foreach ($ProyectosIndicador as $proyecto) {
                if ($proyecto->Clave_Indicador == $indicador->Clave) {
                    $dataIndicadores [$indicador->Descripcion] = $i;
                    $i++;
                }
            }
            $i = 1;
        }

        $indicadores = array_keys($dataIndicadores);
        $conteoIndicadores = array_values($dataIndicadores);

        //PROYECTOS POR AREA
        $ProyectosArea = DB::table('Proyectos')
            ->leftJoin('Areas', 'Proyectos.Clave_Area', 'Areas.Clave')
            ->select('Proyectos.Descripcion as Proyecto', 'Areas.Descripcion as Area', 'Proyectos.Clave_Area')
            ->get();

        $areas = Areas::where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $areas = $areas->unique('Descripcion');
        $dataAreas = [];

        $i = 1;
        foreach ($areas as $area) {
            foreach ($ProyectosArea as $proyecto) {
                if ($proyecto->Clave_Area == $area->Clave) {
                    $dataAreas [$area->Descripcion] = $i;
                    $i++;
                }
            }
            $i = 1;
        }

        $areas = array_keys($dataAreas);
        $conteoAreas = array_values($dataAreas);

        //PROYECTOS POR ESTADO
        $ProyectosEstado = DB::table('Proyectos')
            ->leftJoin('Status', 'Proyectos.Clave_Status', 'Status.Clave')
            ->select('Proyectos.Descripcion as Proyecto', 'Status.status as Estado', 'Proyectos.Clave_Status')
            ->get();

        $estados = Status::where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $estados = $estados->unique('status');
        $dataEstados = [];

        $i = 1;
        foreach ($estados as $estado) {
            foreach ($ProyectosEstado as $proyecto) {
                if ($proyecto->Clave_Status == $estado->Clave) {
                    $dataEstados [$estado->status] = $i;
                    $i++;
                }
            }
            $i = 1;
        }

        $estados = array_keys($dataEstados);
        $conteoEstados = array_values($dataEstados);

        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();

        return view('Admin.Graficas.proyectos', compact(
            'ProyectosEnfoque', 'ProyectosTrabajo', 'ProyectosFase','ProyectosIndicador','ProyectosArea','ProyectosEstado', 'compania',
                    'peCrecimiento', 'peCalidad', 'peGente', 'peServicio', 'peCosto',
                    'ptOperaciones', 'ptAdministrativo', 'ptProyectos', 'ptIniciativas',
                    'fases', 'conteoFases',
                    'indicadores', 'conteoIndicadores',
                    'areas', 'conteoAreas',
                    'estados', 'conteoEstados'));
    }

    public function toActivities() {
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
        return view('Admin.Graficas.actividades', ['compania' => $compania]);
    }
}
