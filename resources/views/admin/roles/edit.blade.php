@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title with-border">Crear Role</h3>
                </div>
                <div class="box-body">

                    @include('admin.partials.errors-messages')

                    <form method="POST" action="{{ route('admin.roles.update') }}">
                        @method('PUT')

                        @include('admin.roles.form')

                        <button type="submit" class="btn btn-primary btn-block">Crear Role</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
