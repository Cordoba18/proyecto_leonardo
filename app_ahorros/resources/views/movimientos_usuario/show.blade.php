@extends('plantilla');

@section('content')
    <div class="container justify-content-center p-2">
        <div class="card text-center">
            <div class="card-header">

                <h5 class="card-title">MOVIMIENTOS DE USUARIO</h5>

            </div>
            <div class="card-body">
                <p class="card-text">Deseas agregar un gasto o ingreso?</p>

                <a href="{{ route('gastos_ingresos') }}" class="btn btn-primary">AGREGAR GASTO O INGRESO</a>

                <br><br>

                <div class="card p-2">
                    @if (session('message'))
                        <p class="alert alert-success" role="alert" class=""> {{ session('message') }}</p>
                    @endif
                    <br>
                    <div class="card">
                        <div class="card-header">
                            MIS GASTOS E INGRESOS
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-striped" >
                            <table class="table table-hover display" id="table_metas_ahorros">
                                <thead>
                                    <th>ID</th>
                                    <th>DETALLE</th>
                                    <th>VALOR</th>
                                    <th>FECHA</th>
                                    <th>PERIODO</th>
                                    <th>TIPO DE DINERO</th>
                                    <th>TARJETA</th>
                                    <th>ELIMINAR</th>
                                </thead>
                                <tbody>
                                    @foreach ($gastos_ingresos as $g)
                                        <tr class="@if ($g->id_tipo_dinero == 2)
                                            table-danger
                                            @else
                                            table-success
                                             @endif" >
                                             <td>{{$g->id }}</td>
                                            <td>{{$g->detalle }}</td>
                                            <td>{{($g->valor) }}</td>
                                            <td>{{$g->fecha }}</td>
                                            @php
                                           $input = preg_replace('/\s+/', '', $g->numero);

// Dividir la cadena en bloques de 3 caracteres
$formatted = chunk_split($input, 3, '-');

// Quitar el último guion adicional al final de la cadena
$formatted = rtrim($formatted, '-');
                                       @endphp
                                            <td>{{$g->periodo }}</td>
                                            <td>{{$g->tipo_dinero }}</td>
                                            <td>{{$g->asociacion }} | {{ $formatted}} |  {{ $g->nombre_banco}} |  {{ $g->tipo_tarjeta}}</td>
                                            <td style="font-size: 40px;font-weight: bold;">
                                                @if ($g->id_tipo_periodo == 1)
                                                <i class="bi bi-cash-stack"></i>
                                                @else
                                                <form action="{{ route('gastos_ingresos.eliminar')}}" method="post" onsubmit="return confirmarEnvio()">
                                                    @csrf
                                            <input type="number" value="{{$g->id}}" hidden name="id_gasto_ingreso">
                                            <button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                            </form>
                                                @endif

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
            var confirmacion = confirm("¿Estás seguro que deseas hacer eso?");
            // Si el usuario hace clic en "Aceptar", el formulario se enviará
            return confirmacion;
        }
    </script>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#table_metas_ahorros').DataTable({
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api();

                // Calcula el total para la columna (índice 2 en este caso)
                var total = api
                    .column(2, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        console.log('Sumando: ', a, b);
                        return parseFloat(a) + parseFloat(b);
                    }, 0);

                console.log('Total calculado: ', total);

                // Actualiza el pie de página
                $(api.column(2).footer()).html(total.toLocaleString('es-CO', {
                    style: 'currency',
                    currency: 'COP'
                }));
            },
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            responsive: true,
            "pageLength": 5,
            "order": [[0, 'desc']],
        });
    });
</script>


@endsection
