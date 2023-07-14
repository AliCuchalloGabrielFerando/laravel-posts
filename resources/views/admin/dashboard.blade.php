@extends('admin.layout')

@section('content')
    <h1>Dashboardd</h1>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit"> Salir </button>
    </form>
@endsection