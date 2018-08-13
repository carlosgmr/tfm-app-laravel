@extends('layout')
@section('title', 'Modificar examen/encuesta')

@section('tools')
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('instructor.questionary.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('instructor.questionary.read', ['id' => $id]) }}">
    <i class="fa fa-eye"></i> Volver a detalles
</a>
@endsection

@section('content')
<form id="formUpdate" action="{{ route('instructor.questionary.updateProcess', ['id' => $id]) }}" method="post">
    @csrf
    <div class="form-group">
        <label for="title">Título</label>
        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $item['title']) }}">
    </div>
    <div class="form-group">
        <label for="description">Descripción</label>
        <textarea id="description" name="description" class="form-control">{{ old('description', $item['description']) }}</textarea>
    </div>
    <div class="form-group">
        <label>Público</label>
        <div class="radio">
            <label><input type="radio" name="public" value="1"@if (strval(old('public', $item['public'])) === '1') checked @endif> Sí</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="public" value="0"@if (strval(old('public', $item['public'])) === '0') checked @endif> No</label>
        </div>
    </div>
    <div class="form-group">
        <label>Activo</label>
        <div class="radio">
            <label><input type="radio" name="active" value="1"@if (strval(old('active', $item['active'])) === '1') checked @endif> Sí</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="active" value="0"@if (strval(old('active', $item['active'])) === '0') checked @endif> No</label>
        </div>
    </div>
</form>
@endsection

@section('footer')
<div>
    <button type="button" class="btn btn-primary" onclick="$('#formUpdate').submit()">Modificar</button>
</div>
@endsection