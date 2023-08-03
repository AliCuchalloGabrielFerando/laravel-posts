@csrf
<div class="form-group">
    <label for="name">Identificador</label>
    @if ($role->exists)
    <input type="text" class="form-control" value="{{ $role->name }}" disabled>
    @else 
    <input name="name" type="text" class="form-control" value="{{ old('name') }}">
    @endif

</div>
<div class="form-group">
    <label for="display_name">Nombre</label>
    <input name="display_name" type="text" class="form-control" value="{{ old('display_name', $role->display_name) }}">
</div>

<div class="form-group">
    <label for="guard_name">Guard:</label>
    <select name="guard_name" id="" class="form-control">
        @foreach (config('auth.guards') as $guardName => $guard)
            <option {{ old('guard_name', $role->guard_name) === $guardName ? 'selected' : '' }}
                value="{{ $guardName }}">
                {{ $guardName }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group col-md-6">
    <label>Permisos</label>
    @include('admin.permissions.checkboxes', ['model' => $role])
</div>
