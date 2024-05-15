@extends('plantilla');

@section('content')
@if (session('message'))
<p class="alert alert-success" role="alert" class=""> {{ session('message') }}</p>
@endif



@endsection
