@extends('plantilla');

@section('content')
    <div class="container justify-content-center p-4">
        <div class="row justify-content-center p-4">
            <div class="card text-bg-light justify-content-center p-4">
                <div class="card-header text-center">

                    <h5 class="card-title">GENERA UN GASTO O INGRESO</h5>

                </div>
                <div class="card-body">

                    <form action="{{route('gastos_ingresos.guardar')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">DETALLE</label>
                            <input required type="text" name="detalle" class="form-control" id="exampleFormControlInput1"
                                placeholder="Ingrese el detalle">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">VALOR</label>
                            <input required type="number" name="valor" class="form-control" id="exampleFormControlInput1"
                                placeholder="Ingrese el valor">
                        </div>
                        <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">FECHA</label>
                        <div class="d-flex justify-content-center"><input type="date"
                                id="fecha" name="fecha"
                                value=""
                                class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">TARJETA</label>
                        <select required class="form-select" name="tarjeta" aria-label="Default select example">
                            <option value="" selected>Seleccione la tarjeta</option>
                            @foreach ($tarjetas as $t)
                                <option value="{{ $t->id }}">{{$t->nombre_banco}} | {{ $t->numero }} | {{$t->asociacion}} </option>
                            @endforeach
                        </select>
                    </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">TIPO DE PERIODO</label>
                            <select required class="form-select" name="tipo_periodo" aria-label="Default select example">
                                <option value="" selected>Seleccione el tipo de periodo</option>
                                @foreach ($tipos_periodos as $t)
                                    <option value="{{ $t->id }}">{{ $t->periodo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">TIPO DE DINERO</label>
                            <div class="d-flex">
                                @foreach ($tipos_dineros as $t)
                                    <div class="form-check-padding">
                                        <input required class="form-check-input" type="radio" name="tipo_dinero"
                                            value="{{ $t->id }}" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            {{ $t->tipo }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
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
                                <a class="btn btn-light" href="{{ route('inicio') }}">VOLVER <i
                                        class="bi bi-arrow-return-left"></i></a>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection


