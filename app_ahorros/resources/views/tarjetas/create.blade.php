@extends('plantilla');

@section('content')
    <div class="container justify-content-center p-4">
        <div class="row justify-content-center p-4">
            <div class="card text-bg-secondary justify-content-center p-4">
                <div class="card-header text-center">

                    <h5 class="card-title">CREAR TARJETA</h5>

                </div>
                <div class="card-body">

                    <form action="{{ route("tarjetas.guardar") }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">NUMERO DE TARJETA</label>
                            <input required type="number" name="numero_tarjeta" class="form-control" id="exampleFormControlInput1"
                                placeholder="Ingrese un numero de tarjeta">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">TIPO DE TARJETA</label>
                            <select required class="form-select" name="tipo_tarjeta" aria-label="Default select example">
                                <option selected>Seleccione el tipo de tarjeta</option>
                                @foreach ($tipos_tarjetas as $t)
                                    <option value="{{ $t->id }}">{{ $t->tipo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ASOCIACIÓN</label>
                            <div class="d-flex">
                                @foreach ($asociaciones as $a)
                                    <div class="form-check-padding">
                                        <input required class="form-check-input" type="radio" name="tipo_asociacion"
                                            value="{{ $a->id }}" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            {{ $a->asociacion }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3" style="width: 18rem">

                            <label for="exampleFormControlInput1" class="form-label">CUOTA DE MANEJO</label>
                            <div class="form-check">

                                <input class="form-check-input" type="checkbox" value="" id="check_cuota_manejo">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Tiene cuota de manejo?
                                </label>
                            </div>
                            <div class="content_fecha_cuota_manejo" hidden>
                                <div class="row">
                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1" class="form-label">FECHA DE CUOTA DE
                                            MANEJO</label>
                                        <div class="d-flex justify-content-center"><input disabled type="date"
                                                id="fecha_cuota_manejo" name="fecha_cuota_manejo"
                                                max="{{ $formatoUltimoDiaDelMes }}" min="{{ $formatoPrimerDiaDelMes }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1" class="form-label">VALOR DE CUOTA DE
                                            MANEJO</label>
                                        <input class="form-control" id="cuota_manejo"  type="number"
                                            name="cuota_manejo" placeholder="Ingrese el valor de la cuota de manejo">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">NOMBRE DEL BANCO</label>
                            <input type="text" name="nombre_banco" class="form-control" id="exampleFormControlInput1"
                            required  placeholder="Ingrese nombre del banco">
                        </div>

                        @if (session('message_error'))
                            <hr>
                            <p class="alert alert-danger" role="alert" class=""> {{ session('message_error') }}</p>
                            <hr>
                        @endif

                        @if (session('message'))
                            <hr>
                            <p class="alert alert-success" role="alert" class=""> {{ session('message') }}</p>
                            <hr>
                        @endif
                        <div class="row">
                            <div class="col-auto">
                                <button class="btn btn-success">GUARDAR</button>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-light" href="{{ route('tarjetas') }}">VOLVER <i
                                        class="bi bi-arrow-return-left"></i></a>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    @vite(['resources/js/create_tarjetas.js'])
@endsection
