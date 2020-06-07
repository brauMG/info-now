<?php


namespace App\Http\Controllers;


use App\Areas;
use App\Charts\ProjectFocusChart;
use App\Compania;
use App\Enfoque;
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

        //PROYECTOS POR TRABAJOS POR ENFOQUE
        $ProyectosTrabajoEnfoque = DB::table('Proyectos')
            ->leftJoin('Trabajos', 'Proyectos.Clave_Trabajo', 'Trabajos.Clave')
            ->leftJoin('Enfoques', 'Proyectos.Clave_Enfoque', 'Enfoques.Clave')
            ->select('Proyectos.Descripcion as Proyecto', 'Trabajos.Descripcion as Trabajo','Enfoques.Descripcion as Enfoque', 'Proyectos.Clave_Enfoque', 'Proyectos.Clave_Trabajo')
            ->get();

        // Operaciones
        $ptfCalidadOperaciones = Proyecto::where('Clave_Enfoque', 1)->where('Clave_Trabajo', 1)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfCalidadOperaciones = count($ptfCalidadOperaciones);
        $ptfGenteOperaciones = Proyecto::where('Clave_Enfoque', 2)->where('Clave_Trabajo', 1)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfGenteOperaciones = count($ptfGenteOperaciones);
        $ptfCostoOperaciones = Proyecto::where('Clave_Enfoque', 3)->where('Clave_Trabajo', 1)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfCostoOperaciones = count($ptfCostoOperaciones);
        $ptfServicioOperaciones = Proyecto::where('Clave_Enfoque', 4)->where('Clave_Trabajo', 1)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfServicioOperaciones = count($ptfServicioOperaciones);
        $ptfCrecimientoOperaciones = Proyecto::where('Clave_Enfoque', 5)->where('Clave_Trabajo', 1)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfCrecimientoOperaciones = count($ptfCrecimientoOperaciones);

        // Administrativo
        $ptfCalidadAdministrativo = Proyecto::where('Clave_Enfoque', 1)->where('Clave_Trabajo', 2)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfCalidadAdministrativo = count($ptfCalidadAdministrativo);
        $ptfGenteAdministrativo = Proyecto::where('Clave_Enfoque', 2)->where('Clave_Trabajo', 2)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfGenteAdministrativo = count($ptfGenteAdministrativo);
        $ptfCostoAdministrativo = Proyecto::where('Clave_Enfoque', 3)->where('Clave_Trabajo', 2)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfCostoAdministrativo = count($ptfCostoAdministrativo);
        $ptfServicioAdministrativo = Proyecto::where('Clave_Enfoque', 4)->where('Clave_Trabajo', 2)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfServicioAdministrativo = count($ptfServicioAdministrativo);
        $ptfCrecimientoAdministrativo = Proyecto::where('Clave_Enfoque', 5)->where('Clave_Trabajo', 2)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfCrecimientoAdministrativo = count($ptfCrecimientoAdministrativo);

        // Proyectos
        $ptfCalidadProyectos = Proyecto::where('Clave_Enfoque', 1)->where('Clave_Trabajo', 3)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfCalidadProyectos = count($ptfCalidadProyectos);
        $ptfGenteProyectos = Proyecto::where('Clave_Enfoque', 2)->where('Clave_Trabajo', 3)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfGenteProyectos = count($ptfGenteProyectos);
        $ptfCostoProyectos = Proyecto::where('Clave_Enfoque', 3)->where('Clave_Trabajo', 3)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfCostoProyectos = count($ptfCostoProyectos);
        $ptfServicioProyectos = Proyecto::where('Clave_Enfoque', 4)->where('Clave_Trabajo', 3)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfServicioProyectos = count($ptfServicioProyectos);
        $ptfCrecimientoProyectos = Proyecto::where('Clave_Enfoque', 5)->where('Clave_Trabajo', 3)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfCrecimientoProyectos = count($ptfCrecimientoProyectos);

        // Iniciativas
        $ptfCalidadIniciativas = Proyecto::where('Clave_Enfoque', 1)->where('Clave_Trabajo', 4)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfCalidadIniciativas = count($ptfCalidadIniciativas);
        $ptfGenteIniciativas = Proyecto::where('Clave_Enfoque', 2)->where('Clave_Trabajo', 4)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfGenteIniciativas = count($ptfGenteIniciativas);
        $ptfCostoIniciativas = Proyecto::where('Clave_Enfoque', 3)->where('Clave_Trabajo', 4)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfCostoIniciativas = count($ptfCostoIniciativas);
        $ptfServicioIniciativas = Proyecto::where('Clave_Enfoque', 4)->where('Clave_Trabajo', 4)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfServicioIniciativas = count($ptfServicioIniciativas);
        $ptfCrecimientoIniciativas = Proyecto::where('Clave_Enfoque', 5)->where('Clave_Trabajo', 4)->where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $ptfCrecimientoIniciativas = count($ptfCrecimientoIniciativas);

        $dataOperaciones = [1 => $ptfCalidadOperaciones, 2 => $ptfGenteOperaciones, 3 => $ptfCostoOperaciones, 4 => $ptfServicioOperaciones, 5 => $ptfCrecimientoOperaciones];
        $dataAdministrativo = [1 => $ptfCalidadAdministrativo, 2 => $ptfGenteAdministrativo, 3 => $ptfCostoAdministrativo, 4 => $ptfServicioAdministrativo, 5 => $ptfCrecimientoAdministrativo];
        $dataProyectos = [1 => $ptfCalidadProyectos, 2 => $ptfGenteProyectos, 3 => $ptfCostoProyectos, 4 => $ptfServicioProyectos, 5 => $ptfCrecimientoProyectos];
        $dataIniciativas = [1 => $ptfCalidadIniciativas, 2 => $ptfGenteIniciativas, 3 => $ptfCostoIniciativas, 4 => $ptfServicioIniciativas, 5 => $ptfCrecimientoIniciativas];

        $dataOperaciones = array_values($dataOperaciones);
        $dataAdministrativo = array_values($dataAdministrativo);
        $dataProyectos = array_values($dataProyectos);
        $dataIniciativas = array_values($dataIniciativas);


        $total = Proyecto::where('Clave_Compania', Auth::user()->Clave_Compania)->get();
        $total = count($total);

        $estados = array_keys($dataEstados);
        $conteoEstados = array_values($dataEstados);

        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();

        return view('Admin.Graficas.proyectos', compact(
            'ProyectosEnfoque', 'ProyectosTrabajo', 'ProyectosFase','ProyectosIndicador','ProyectosArea','ProyectosTrabajoEnfoque','ProyectosEstado', 'compania','total',
                    'peCrecimiento', 'peCalidad', 'peGente', 'peServicio', 'peCosto',
                    'ptOperaciones', 'ptAdministrativo', 'ptProyectos', 'ptIniciativas',
                    'fases', 'conteoFases',
                    'indicadores', 'conteoIndicadores',
                    'areas', 'conteoAreas',
                    'estados', 'conteoEstados',
                    'dataOperaciones', 'dataAdministrativo', 'dataProyectos', 'dataIniciativas'));
    }

    public function toActivities() {
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
        return view('Admin.Graficas.actividades', ['compania' => $compania]);
    }
}
