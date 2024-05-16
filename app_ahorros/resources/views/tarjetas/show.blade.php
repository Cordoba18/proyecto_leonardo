@extends('plantilla');

@section('content')
    <div class="container justify-content-center p-2">
        <div class="card text-center">
            <div class="card-header">

                <h5 class="card-title">MIS TARJETAS</h5>

            </div>
            <div class="card-body">
                <p class="card-text">Deseas crear una tarjeta?</p>

                <a href="{{ route('tarjetas.crear') }}" class="btn btn-primary">CREAR TARJETA</a>

                <br><br>

                <div class="card p-2">
                    @if (session('message'))
                        <p class="alert alert-success" role="alert" class=""> {{ session('message') }}</p>
                    @endif

                    <div class="card-group" style="width: 100%">
                        @foreach ($tarjetas as $t)
                            <div class="card border-success mb-3 m-2" style="max-width: 20rem;">
                                <div class="card-header bg-transparent border-success">{{ $t->tipo }}</div>
                                <div class="card-body text-success">
                                    <h5 class="card-title">{{ $t->numero }}</h5>
                                    <b class="card-text">{{ $t->nombre_banco }}</b>

                                    <hr>
                                    <table class="table table-hover" style="font-size: 14px;">

                                        <thead>
                                            <th>CUOTA DE MANEJO</th>
                                            <th>FECHA</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    @if ($t->cuota_manejo)
                                                        ${{ number_format($t->cuota_manejo) }}
                                                    @else
                                                        $0
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($t->fecha_cuota_manejo)
                                                        {{ $t->fecha_cuota_manejo }}
                                                    @else
                                                        00/00/0000
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <hr>


                                    <form action="{{ route('tarjetas.eliminar') }}" method="post"
                                        onsubmit="return confirmarEnvio()">
                                        @csrf
                                        <input type="number" hidden value="{{ $t->id }}" name="id_tarjeta">
                                        <button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </div>
                                <div class="card-footer bg-transparent border-success">{{ $t->asociacion }}</div>
                            </div>
                        @endforeach


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
            var confirmacion = confirm("¿Estás seguro de eliminar esta tarjeta?");
            // Si el usuario hace clic en "Aceptar", el formulario se enviará
            return confirmacion;
        }
    </script>
@endsection
