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

                    <div class="card">
                        <div class="card-header">
                            Mis metas de ahorro
                        </div>
                        <div class="card-body">
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
