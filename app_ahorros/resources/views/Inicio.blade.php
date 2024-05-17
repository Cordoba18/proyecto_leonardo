@extends('plantilla');
@section('title', 'INICIO')
@php
    $user = Auth::user();
@endphp
@section('content')
    @if (session('message'))
        <p class="alert alert-success" role="alert" class=""> {{ session('message') }}</p>
    @endif
    <div class="container justify-content-center p-2">
        <div class="card p-2 text-center">

            <div class="card">
                <div class="card-header">
                    GASTOS Y INGRESOS DE HOY
                </div>
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                    </figure>
                </div>
            </div>

            <div class="row justify-content-center p-4">
                <div class="col-sm-6  mb-5 mb-sm-0">
                    <div class="card">
                        <div class="card-header">
                            GASTOS Y INGRESOS DE LA SEMANA
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table_hover" id="tabla_ingresos_gastos">
                                    <thead>

                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6  mb-5 mb-sm-0">
                    <figure class="highcharts-figure">
                        <div id="container2"></div>
                    </figure>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                   INFORMACIÓN DE PERFIL
                </div>
                <div class="card-body">
                    <div class="row justify-content-center p-4">
                        <div class="col-sm-4  mb-5 mb-sm-0">
                            <div class="card">
                                <div class="card-header">
                                    NOMBRE COMPLETO
                                </div>
                                <div class="card-body">
                                    <div class="title">{{ $user->nombres }} {{ $user->apellidos }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4  mb-5 mb-sm-0">
                            <div class="card">
                                <div class="card-header">
                                   CORREO
                                </div>
                                <div class="card-body">
                                    <div class="title">{{ $user->email }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4  mb-5 mb-sm-0">
                            <div class="card">
                                <div class="card-header">
                                    NUMERO DE IDENTIFICACIÓN
                                </div>
                                <div class="card-body">
                                    <div class="title">{{ $user->numero_de_identificacion }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection


@section('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <SCript>
        Highcharts.chart('container2', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'PORCENTAJE GASTOS Y INGRESOS DE LA SEMANA'
            },
            tooltip: {
                valueSuffix: '%'
            },
            subtitle: {
                text: 'Source:<a href="https://www.mdpi.com/2072-6643/11/3/684/htm" target="_default">MDPI</a>'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: [{
                        enabled: true,
                        distance: 20
                    }, {
                        enabled: true,
                        distance: -40,
                        format: '{point.percentage:.1f}%',
                        style: {
                            fontSize: '1.2em',
                            textOutline: 'none',
                            opacity: 0.7
                        },
                        filter: {
                            operator: '>',
                            property: 'percentage',
                            value: 10
                        }
                    }]
                }
            },
            series: [{
                name: 'Porcentaje',
                colorByPoint: true,
                data: [{
                        name: 'Water',
                        y: 55.02
                    },
                    {
                        name: 'Fat',
                        sliced: true,
                        selected: true,
                        y: 26.71
                    },
                    {
                        name: 'Carbohydrates',
                        y: 1.09
                    },
                    {
                        name: 'Protein',
                        y: 15.5
                    },
                    {
                        name: 'Ash',
                        y: 1.68
                    }
                ]
            }]
        });
    </SCript>
    <script>
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'FECHA {{ $fechaActual }}',
                align: 'left'
            },
            subtitle: {
                text: 'Source: <a target="_blank" ' +
                    'href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>',
                align: 'left'
            },
            xAxis: {
                categories: ['USA', 'China', 'Brazil', 'EU', 'India', 'Russia'],
                crosshair: true,
                accessibility: {
                    description: 'Countries'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '1000 metric tons (MT)'
                }
            },
            tooltip: {
                valueSuffix: ' (1000 MT)'
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                    name: 'Corn',
                    data: [406292, 260000, 107000, 68300, 27500, 14500]
                },
                {
                    name: 'Wheat',
                    data: [51086, 136000, 5500, 141000, 107180, 77000]
                }
            ]
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#tabla_ingresos_gastos').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                responsive: true,
                "pageLength": 5
            });
        });
    </script>
@endsection
