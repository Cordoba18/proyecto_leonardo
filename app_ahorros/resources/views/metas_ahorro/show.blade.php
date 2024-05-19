@extends('plantilla');

@section('content')
    <div class="container justify-content-center p-2">
        <div class="card text-center">
            <div class="card-header">

                <h5 class="card-title">MIS METAS DE AHORRO</h5>

            </div>
            <div class="card-body">
                <p class="card-text">Deseas fijar una nueva meta de ahorro?</p>

                <a href="{{ route('metas_ahorro.crear') }}" class="btn btn-primary">FIJAR META DE AHORRO </a>

                <br><br>

                <div class="card p-2">
                    @if (session('message'))
                        <p class="alert alert-success" role="alert" class=""> {{ session('message') }}</p>
                    @endif

                    <div class="card text-center">
                        <div class="card-header">
                            POSIBLES AHORROS EN BASE A GASTOS + CUOTAS DE MANEJO E INGRESOS PERIODICOS MENSUALMENTE
                        </div>
                        <div class="card-body">

                            <div class="row justify-content-center p-1">
                                <div class="col-auto">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-header"><b>INDIQUE SU TARJETA</div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Filtrar</label>
                                                <br>
                                                <div style="display:flex;">
                                                    <select class="form-select form-select-sm" aria-label="Small select example" id="select_tarjetas">
                                                        <option selected value="">Todas mis tarjetas</option>
                                                        @foreach ($tarjetas as $t )

                                                        @php
                                                          $input = preg_replace('/\s+/', '', $t->numero);

// Dividir la cadena en bloques de 3 caracteres
$formatted = chunk_split($input, 3, '-');

// Quitar el último guion adicional al final de la cadena
$formatted = rtrim($formatted, '-');
                                                        @endphp
                                                        <option value="{{$t->id}}">{{$formatted}} | {{$t->asociacion}}</option>
                                                        @endforeach
                                                      </select>
                                            </div>
                                        </div>
                                      </div>
                                </div>
                                </div>
                                <div class="row justify-content-center p-4">
                                    <div class="col-sm-6  mb-5 mb-sm-0">
                                    <div class="card text-bg-success mb-3" style="width:100%;">
                                        <div class="card-header"><b>INGRESOS  <i class="bi bi-graph-up-arrow"></i></b><br> MES | QUINCENAL</div>
                                        <div class="card-body">
                                          <h5 class="card-title" id="valor_ingresos"><span class="placeholder col-10"></span></h5>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-sm-6 mb-5 mb-sm-0">
                                    <div class="card text-bg-danger mb-3" style="width:100%;">
                                        <div class="card-header"><b>GASTOS  <i class="bi bi-graph-down-arrow"></i></b> <br> MES | QUINCENAL</div>
                                        <div class="card-body">
                                          <h5 class="card-title" id="valor_gastos"><span class="placeholder col-10"></span></h5>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-sm-6  mb-5 mb-sm-0">
                                    <div class="card text-bg-light mb-3" style="width:100%;">
                                        <div class="card-header"><b>POSIBLE AHORRO <i class="bi bi-wallet2"></i></b><br> MES | QUINCENAL </div>
                                        <div class="card-body">
                                          <h5 class="card-title" id="valor_ahorro"><span class="placeholder col-10"></span></h5>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-sm-6  mb-5 mb-sm-0">
                                    <div class="card text-bg-dark  mb-3" style="width:100%;">
                                        <div class="card-header"><b>SOBRANTE  <i class="bi bi-cash"></i></b><br>MES | QUINCENAL</div>
                                        <div class="card-body">
                                          <h5 class="card-title" id="valor_sobrante"><span class="placeholder col-10"></span></h5>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-body-secondary">
                            Dellada tus datos en el apartado de "Movimientos de usuario". Segun el <a href="https://www.canalinstitucional.tv/cuanto-sueldo-ahorrar-consejos-financieros-2022">CANAL INSTITUCIONAL TV</a> una persona debe de ahorrar el 20% de sus ingresos mensuales.
                          </div>
                    </div>

                    <br>
                    <div class="card">
                        <div class="card-header">
                            Mis metas de ahorro
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" >
                            <table class="table" id="table_metas_ahorros">
                                <thead>
                                    <th>NOMBRE</th>
                                    <th>DESCRIPCIÓN</th>
                                    <th>VALOR</th>
                                    <th>FECHA DE INICIO</th>
                                    <th>FECHA DE FINAL</th>
                                    <th>EDITAR/ELIMINAR</th>
                                </thead>
                                <tbody>
                                    @foreach ($metas_ahorros as $m)
                                        <tr>
                                            <td>{{$m->nombre }}</td>
                                            <td>{{$m->descripcion }}</td>
                                            <td>${{number_format($m->valor) }}</td>
                                            <td>{{$m->fecha_inicio }}</td>
                                            <td>{{$m->fecha_final }}</td>
                                            <td><a href="{{ route('metas_ahorro.editar', $m->id)}}" class="btn btn-success"><i class="bi bi-eye-fill"></i></a>
                                                <form action="{{ route('metas_ahorro.eliminar')}}" method="post" onsubmit="return confirmarEnvio()">
                                                    @csrf
                                            <input type="number" value="{{$m->id}}" hidden name="id_meta_ahorro">
                                            <button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                            </form>
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>

    </div>
@endsection


@section('js')
    <script>
        function confirmarEnvio() {
            // Mostrar un mensaje de confirmación
            var confirmacion = confirm("¿Estás seguro de eliminar esta meta de ahorro?");
            // Si el usuario hace clic en "Aceptar", el formulario se enviará
            return confirmacion;
        }
    </script>

@vite(['resources/js/show_ahorros.js'])

<script>




    document.addEventListener('DOMContentLoaded', function () {
$('#table_metas_ahorros').DataTable({
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
