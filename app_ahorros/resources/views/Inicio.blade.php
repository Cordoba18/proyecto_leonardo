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
                                <table class="table table-hover" id="tabla_ingresos_gastos">
                                    <thead>
                                        <th>DETALLE DE MOVIMIENTO</th>
                                        <th>VALOR</th>
                                        <th>FECHA</th>
                                        <th>TARJETA</th>
                                        <th>TIPO DE DINERO</th>
                                    </thead>

                                    <tbody id="filas_semanales">

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
@vite(['resources/js/inicio.js'])
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>


function activar_tabla() {

            $('#tabla_ingresos_gastos').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                responsive: true,
                "pageLength": 5,
            });

}


    </script>
@endsection
