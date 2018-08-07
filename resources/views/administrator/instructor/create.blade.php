@extends('layout')
@section('title', 'Crear instructor')

@section('tools')
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('administrator.instructor.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
@endsection

@section('content')
<form id="formCreate" action="{{ route('administrator.instructor.createProcess') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}">
    </div>
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <label for="surname_1">1º apellido</label>
        <input type="text" id="surname_1" name="surname_1" class="form-control" value="{{ old('surname_1') }}">
    </div>
    <div class="form-group">
        <label for="surname_2">2º apellido</label>
        <input type="text" id="surname_2" name="surname_2" class="form-control" value="{{ old('surname_2') }}">
    </div>
    <div class="form-group">
        <label>Activo</label>
        <div class="radio">
            <label><input type="radio" name="active" value="1"@if (old('active') === '1') checked @endif> Sí</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="active" value="0"@if (old('active') === '0') checked @endif> No</label>
        </div>
    </div>
</form>
@endsection

@section('footer')
<div>
    <button type="button" class="btn btn-primary" onclick="$('#formCreate').submit()">Crear</button>
</div>
@endsection