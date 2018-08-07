@extends('layout')
@section('title', 'Crear grupo')

@section('tools')
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('administrator.group.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
@endsection

@section('content')
<form id="formCreate" action="{{ route('administrator.group.createProcess') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <label for="description">Descripción</label>
        <input type="text" id="description" name="description" class="form-control" value="{{ old('description') }}">
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