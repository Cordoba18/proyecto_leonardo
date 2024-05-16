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
                            POSIBLES AHORROS EN BASE A GASTOS E INGRESOS PERIODICOS MENSUALMENTE
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center p-4">

                                <div class="col-auto">
                                    <div class="card text-bg-success mb-3" style="max-width: 18rem;">
                                        <div class="card-header">INGRESOS</div>
                                        <div class="card-body">
                                          <h5 class="card-title" id="valor_ingresos"><span class="placeholder col-10"></span></h5>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-auto">
                                    <div class="card text-bg-danger mb-3" style="max-width: 18rem;">
                                        <div class="card-header">GASTOS</div>
                                        <div class="card-body">
                                          <h5 class="card-title" id="valor_gastos"><span class="placeholder col-10"></span></h5>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-auto">
                                    <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                                        <div class="card-header">POSIBLE AHORRO</div>
                                        <div class="card-body">
                                          <h5 class="card-title" id="valor_ahorro"><span class="placeholder col-10"></span></h5>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-auto">
                                    <div class="card text-bg-dark  mb-3" style="max-width: 18rem;">
                                        <div class="card-header">SOBRANTE</div>
                                        <div class="card-body">
                                          <h5 class="card-title" id="valor_sobrante"><span class="placeholder col-10"></span></h5>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-body-secondary">



                            Dellada tus datos en el apartado de "Movimientos de usuario".

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

@vite(['resources/js/show_ahorros'])

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
