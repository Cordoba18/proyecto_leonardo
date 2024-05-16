@extends('plantilla');

@section('content')
    <div class="container justify-content-center p-4">
        <div class="row justify-content-center p-4">
            <div class="card text-bg-success justify-content-center p-4">
                <div class="card-header text-center">

                    <h5 class="card-title">FIJAR MI META DE AHORRO</h5>

                </div>
                <div class="card-body">

                    <form action="{{ route("metas_ahorro.crear.guardar") }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">NOMBRE DE LA META</label>
                            <input type="text" name="nombre" class="form-control" id="exampleFormControlInput1"
                              required  placeholder="Ingrese un nombre">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">DESCRIPCIÓN</label>
                            <textarea required class="form-control" id="exampleFormControlTextarea1" name="descripcion" rows="3"></textarea>
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">VALOR DE LA META</label>
                            <input required type="number" name="valor" class="form-control" id="exampleFormControlInput1"
                                placeholder="Ingrese el valor a alcanzar">
                        </div>
<div class="mb-3"> <label for="exampleFormControlInput1" class="form-label">FECHA DE INICIO</label>
<div class="d-flex justify-content-center"><input required type="date"
        id="fecha_inicio" name="fecha_inicio"
        class="form-control">
</div>
</div>

<div class="mb-3"> <label for="exampleFormControlInput1" class="form-label">FECHA DE FINAL</label>
    <div class="d-flex justify-content-center"><input required type="date"
            id="fecha_final" name="fecha_final"
            class="form-control">
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
                                <a class="btn btn-light" href="{{ route('metas_ahorro') }}">VOLVER <i
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
    @vite(['resources/js/create_metas_ahorro.js'])
@endsection
