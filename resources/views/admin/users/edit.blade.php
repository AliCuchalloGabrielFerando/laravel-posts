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

                    @if ($errors->any())
                        <ul class="list-group">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control"
                                value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="form-group">
                            <label for="password">Escribe tu nueva contraseña</label>
                            <input name="password" type="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Repite el Password</label>
                            <input name="password_confirmation" type="password" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Actualizar Usuario</button>

                    </form>
                </div>
            </div>
        </div>
        <!--ROLES Y PERMISOS-->
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Roles</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{route('admin.users.roles.update',$user)}}">
                        @csrf @method('PUT')
                    @foreach ($roles as $id => $name)
                        <div class="checkbox">
                            <label>
                                <input name="roles[]" type="checkbox" value="{{ $name }}" {{$user->roles->contains($id)? 'checked':''}}>
                                {{ $name }}
                            </label>
                        </div>
                    @endforeach
                    <button class="btn btn-primary btn-block">Actualizar Roles</button>
                </form>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Permisos</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{route('admin.users.permissions.update',$user)}}">
                        @csrf @method('PUT')
                    @foreach ($permissions as $id => $name)
                        <div class="checkbox">
                            <label>
                                <input name="permissions[]" type="checkbox" value="{{ $name }}" {{$user->permissions->contains($id)? 'checked':''}}>
                                {{ $name }}
                            </label>
                        </div>
                    @endforeach
                    <button class="btn btn-primary btn-block">Actualizar Permisos</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
