@extends('layout')

@section('content')
    <section class="pages container">
        <div class="page page-about">
            <h1 class="text-capitalize">Pagina no Autorizada</h1>
            <span style="color:red"> <h2 class="text-capitalize">{{ $exception->getMessage() }}</h2></span>
            <p><a href="{{url()->previous()}}">Volver</a></p>
        </div>
    </section>
@endsection