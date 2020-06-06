@extends('layouts.app')
@if($compania!=null)
    @section('company',$compania->Descripcion)
@endif
@section('content')
    @include('layouts.top-nav')
        <div class="container adjust">
            <div data-simplebar class="card-height-add-test" style="height: 980px !important;">
                <div class="col text-center">
                    <div class="justify-content-center">

                        <div class="card card-see-results" style="border: solid; margin-bottom: 3% !important;">
                            <div class="card-header card-header-cute" style="background-color: #055e76 !important">
                                <h4 class="no-bottom" style="text-transform: uppercase">Proyectos Por Enfoque</h4>
                            </div>
                            <div class="card-body" style="background-color: rgba(176, 249, 255, 0.39) !important;">
                                <div class="row bg-transparent rounded mb-0 column" style="background-color: white !important;">
                                    <div class="col-xl-4 max" style="padding-top: 5%; padding-left: 10%">
                                        <div class="row row2 ">
                                            <table class="table-responsive table-card-inline">
                                                <thead class="thead"  style="text-align: left">
                                                <tr class="tr-card-complete">
                                                    <th scope="col" class="th-card"><i class="far fa-check-square"></i> Proyecto</th>
                                                    <th scope="col" class="th-card"><i class="far fa-check-circle"></i> Enfoque</th>
                                                </tr>
                                                </thead>
                                                <tbody class="fonts" style="text-align: left">
                                                @foreach($ProyectosEnfoque as $PE)
                                                        <tr class="tr-card-complete">
                                                            <td class="td" style="padding-top: 1%"><i class="fas fa-check-square"></i> {{$PE->Proyecto}}</td>
                                                            <td class="td" style="padding-top: 1%"><i class="fas fa-check-circle"></i> {{$PE->Enfoque}}</td>
                                                        </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row2 col-xl-8 max my-auto ">
                                        <div class="card bg-transparent" style="border: none; ">
                                            <div class="card-body">
                                                <div class="chart">
                                                    <canvas id="ChartFocus"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-see-results" style="border: solid; margin-bottom: 3% !important;">
                            <div class="card-header card-header-cute" style="background-color: #055e76 !important">
                                <h4 class="no-bottom" style="text-transform: uppercase">Proyectos Por Trabajo</h4>
                            </div>
                            <div class="card-body" style="background-color: rgba(176, 249, 255, 0.39) !important;">
                                <div class="row bg-transparent rounded mb-0 column" style="background-color: white !important;">
                                    <div class="col-xl-4 max" style="padding-top: 5%; padding-left: 10%">
                                        <div class="row row2 ">
                                            <table class="table-responsive table-card-inline">
                                                <thead class="thead"  style="text-align: left">
                                                <tr class="tr-card-complete">
                                                    <th scope="col" class="th-card"><i class="far fa-check-square"></i> Proyecto</th>
                                                    <th scope="col" class="th-card"><i class="far fa-check-circle"></i> Trabajo</th>
                                                </tr>
                                                </thead>
                                                <tbody class="fonts" style="text-align: left">
                                                @foreach($ProyectosTrabajo as $PT)
                                                    <tr class="tr-card-complete">
                                                        <td class="td" style="padding-top: 1%"><i class="fas fa-check-square"></i> {{$PT->Proyecto}}</td>
                                                        <td class="td" style="padding-top: 1%"><i class="fas fa-check-circle"></i> {{$PT->Trabajo}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row2 col-xl-8 max my-auto ">
                                        <div class="card bg-transparent" style="border: none; ">
                                            <div class="card-body">
                                                <div class="chart">
                                                    <canvas id="ChartJob"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-see-results" style="border: solid; margin-bottom: 3% !important;">
                            <div class="card-header card-header-cute" style="background-color: #055e76 !important">
                                <h4 class="no-bottom" style="text-transform: uppercase">Proyectos Por Fase</h4>
                            </div>
                            <div class="card-body" style="background-color: rgba(176, 249, 255, 0.39) !important;">
                                <div class="row bg-transparent rounded mb-0 column" style="background-color: white !important;">
                                    <div class="col-xl-4 max" style="padding-top: 5%; padding-left: 10%">
                                        <div class="row row2 ">
                                            <table class="table-responsive table-card-inline">
                                                <thead class="thead"  style="text-align: left">
                                                <tr class="tr-card-complete">
                                                    <th scope="col" class="th-card"><i class="far fa-check-square"></i> Proyecto</th>
                                                    <th scope="col" class="th-card"><i class="far fa-check-circle"></i> Fase</th>
                                                </tr>
                                                </thead>
                                                <tbody class="fonts" style="text-align: left">
                                                @foreach($ProyectosFase as $PF)
                                                    <tr class="tr-card-complete">
                                                        <td class="td" style="padding-top: 1%"><i class="fas fa-check-square"></i> {{$PF->Proyecto}}</td>
                                                        <td class="td" style="padding-top: 1%"><i class="fas fa-check-circle"></i> {{$PF->Fase}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row2 col-xl-8 max my-auto ">
                                        <div class="card bg-transparent" style="border: none; ">
                                            <div class="card-body">
                                                <div class="chart">
                                                    <canvas id="ChartStage"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-see-results" style="border: solid; margin-bottom: 3% !important;">
                            <div class="card-header card-header-cute" style="background-color: #055e76 !important">
                                <h4 class="no-bottom" style="text-transform: uppercase">Proyectos Por Indicador</h4>
                            </div>
                            <div class="card-body" style="background-color: rgba(176, 249, 255, 0.39) !important;">
                                <div class="row bg-transparent rounded mb-0 column" style="background-color: white !important;">
                                    <div class="col-xl-4 max" style="padding-top: 5%; padding-left: 10%">
                                        <div class="row row2 ">
                                            <table class="table-responsive table-card-inline">
                                                <thead class="thead"  style="text-align: left">
                                                <tr class="tr-card-complete">
                                                    <th scope="col" class="th-card"><i class="far fa-check-square"></i> Proyecto</th>
                                                    <th scope="col" class="th-card"><i class="far fa-check-circle"></i> Indicador</th>
                                                </tr>
                                                </thead>
                                                <tbody class="fonts" style="text-align: left">
                                                @foreach($ProyectosIndicador as $PI)
                                                    <tr class="tr-card-complete">
                                                        <td class="td" style="padding-top: 1%"><i class="fas fa-check-square"></i> {{$PI->Proyecto}}</td>
                                                        <td class="td" style="padding-top: 1%"><i class="fas fa-check-circle"></i> {{$PI->Indicador}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row2 col-xl-8 max my-auto ">
                                        <div class="card bg-transparent" style="border: none; ">
                                            <div class="card-body">
                                                <div class="chart">
                                                    <canvas id="ChartIndicator"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-see-results" style="border: solid; margin-bottom: 3% !important;">
                            <div class="card-header card-header-cute" style="background-color: #055e76 !important">
                                <h4 class="no-bottom" style="text-transform: uppercase">Proyectos Por Área</h4>
                            </div>
                            <div class="card-body" style="background-color: rgba(176, 249, 255, 0.39) !important;">
                                <div class="row bg-transparent rounded mb-0 column" style="background-color: white !important;">
                                    <div class="col-xl-4 max" style="padding-top: 5%; padding-left: 10%">
                                        <div class="row row2 ">
                                            <table class="table-responsive table-card-inline">
                                                <thead class="thead"  style="text-align: left">
                                                <tr class="tr-card-complete">
                                                    <th scope="col" class="th-card"><i class="far fa-check-square"></i> Proyecto</th>
                                                    <th scope="col" class="th-card"><i class="far fa-check-circle"></i> Área</th>
                                                </tr>
                                                </thead>
                                                <tbody class="fonts" style="text-align: left">
                                                @foreach($ProyectosArea as $PA)
                                                    <tr class="tr-card-complete">
                                                        <td class="td" style="padding-top: 1%"><i class="fas fa-check-square"></i> {{$PA->Proyecto}}</td>
                                                        <td class="td" style="padding-top: 1%"><i class="fas fa-check-circle"></i> {{$PA->Area}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row2 col-xl-8 max my-auto ">
                                        <div class="card bg-transparent" style="border: none; ">
                                            <div class="card-body">
                                                <div class="chart">
                                                    <canvas id="ChartArea"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-see-results" style="border: solid; margin-bottom: 3% !important;">
                            <div class="card-header card-header-cute" style="background-color: #055e76 !important">
                                <h4 class="no-bottom" style="text-transform: uppercase">Proyectos Por Área</h4>
                            </div>
                            <div class="card-body" style="background-color: rgba(176, 249, 255, 0.39) !important;">
                                <div class="row bg-transparent rounded mb-0 column" style="background-color: white !important;">
                                    <div class="col-xl-4 max" style="padding-top: 5%; padding-left: 10%">
                                        <div class="row row2 ">
                                            <table class="table-responsive table-card-inline">
                                                <thead class="thead"  style="text-align: left">
                                                <tr class="tr-card-complete">
                                                    <th scope="col" class="th-card"><i class="far fa-check-square"></i> Proyecto</th>
                                                    <th scope="col" class="th-card"><i class="far fa-check-circle"></i> Área</th>
                                                </tr>
                                                </thead>
                                                <tbody class="fonts" style="text-align: left">
                                                @foreach($ProyectosEstado as $PE)
                                                    <tr class="tr-card-complete">
                                                        <td class="td" style="padding-top: 1%"><i class="fas fa-check-square"></i> {{$PE->Proyecto}}</td>
                                                        <td class="td" style="padding-top: 1%"><i class="fas fa-check-circle"></i> {{$PE->Estado}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row2 col-xl-8 max my-auto ">
                                        <div class="card bg-transparent" style="border: none; ">
                                            <div class="card-body">
                                                <div class="chart">
                                                    <canvas id="ChartStatus"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </div>
            </div>

    <script>
        var ctx1 = document.getElementById("ChartFocus");
        var ctx2 = document.getElementById("ChartJob");
        var ctx3 = document.getElementById("ChartStage");
        var ctx4 = document.getElementById("ChartIndicator");
        var ctx5 = document.getElementById("ChartArea");
        var ctx6 = document.getElementById("ChartStatus");
        var lineChart1 = new Chart(ctx1, {
            type: 'horizontalBar',
            data: {
                labels: [
                    'Calidad',
                    'Crecimiento',
                    'Costo',
                    'Gente',
                    'Servicio'
                ],
                datasets: [{
                    data:
                        [
                            {{$peCalidad}},
                            {{$peCrecimiento}},
                            {{$peCosto}},
                            {{$peGente}},
                            {{$peServicio}}
                        ],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"],
                    borderWidth: 5,
                    scaleSteps: 5,
                    scaleStepWidth: 50,
                    scaleStartValue: 0,
                }]
            },
            options: {
                // plugins: {}
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            min: 0,
                        },
                        gridLines: {
                            drawOnChartArea: false
                        },
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            min: 0,
                        },
                        gridLines: {
                            drawOnChartArea: false
                        },
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true
                }
            }
        });

        var lineChart2 = new Chart(ctx2, {
            type: 'horizontalBar',
            data: {
                labels: [
                    'Operaciones',
                    'Administrativo',
                    'Proyectos',
                    'Iniciativa'
                ],
                datasets: [{
                    data:
                        [
                            {{$ptOperaciones}},
                            {{$ptAdministrativo}},
                            {{$ptProyectos}},
                            {{$ptIniciativas}}
                        ],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"],
                    borderWidth: 5,
                    scaleSteps: 5,
                    scaleStepWidth: 50,
                    scaleStartValue: 0,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            min: 0,
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            min: 0,
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true
                }
            }
        });

        var lineChart3 = new Chart(ctx3, {
            type: 'horizontalBar',
            data: {
                labels: [
                    @foreach($fases as $fase)
                    "{{$fase}}",
                    @endforeach
                ],
                datasets: [{
                    data:
                        [
                            @foreach($conteoFases as $conteo)
                                "{{$conteo}}",
                            @endforeach
                        ],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"],
                    borderWidth: 5,
                    scaleSteps: 5,
                    scaleStepWidth: 50,
                    scaleStartValue: 0,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            min: 0,
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            min: 0,
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true
                }
            }
        });

        var lineChart4 = new Chart(ctx4, {
            type: 'horizontalBar',
            data: {
                labels: [
                    @foreach($indicadores as $indicador)
                        "{{$indicador}}",
                    @endforeach
                ],
                datasets: [{
                    data:
                        [
                            @foreach($conteoIndicadores as $conteo)
                                "{{$conteo}}",
                            @endforeach
                        ],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"],
                    borderWidth: 5,
                    scaleSteps: 5,
                    scaleStepWidth: 50,
                    scaleStartValue: 0,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            min: 0,
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            min: 0,
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true
                }
            }
        });

        var lineChart5 = new Chart(ctx5, {
            type: 'horizontalBar',
            data: {
                labels: [
                    @foreach($areas as $area)
                        "{{$area}}",
                    @endforeach
                ],
                datasets: [{
                    data:
                        [
                            @foreach($conteoAreas as $conteo)
                                "{{$conteo}}",
                            @endforeach
                        ],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"],
                    borderWidth: 5,
                    scaleSteps: 5,
                    scaleStepWidth: 50,
                    scaleStartValue: 0,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            min: 0,
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            min: 0,
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true
                }
            }
        });

        var lineChart6 = new Chart(ctx6, {
            type: 'horizontalBar',
            data: {
                labels: [
                    @foreach($estados as $estado)
                        "{{$estado}}",
                    @endforeach
                ],
                datasets: [{
                    data:
                        [
                            @foreach($conteoEstados as $conteo)
                                "{{$conteo}}",
                            @endforeach
                        ],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"],
                    borderWidth: 5,
                    scaleSteps: 5,
                    scaleStepWidth: 50,
                    scaleStartValue: 0,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            min: 0,
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            min: 0,
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true
                }
            }
        });
    </script>
@endsection
