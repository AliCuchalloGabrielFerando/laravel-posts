@extends('admin.layout')

@section('content')
    <div class="row">
        <!--DATOS PERSONALES-->
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title with-border">Datos Personales</h3>
                </div>
                <div class="box-body">

                    @include('admin.partials.errors-messages')

                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control" value="{{ old('email') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Roles</label>
                            @include('admin.roles.checkboxes')

                        </div>
                        <div class="form-group col-md-6">
                            <label>Permisos</label>
                            @include('admin.permissions.checkboxes',['model'=>$user])
                        </div>
                        <span class="help-block">La contraseña sera generada y enviada a su correo electronico</span>
                        <button type="submit" class="btn btn-primary btn-block">Crear Usuario</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
