@extends('layout')
@section('title', 'Crear examen/encuesta')

@section('tools')
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('instructor.questionary.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
@endsection

@section('content')
<form id="formCreate" action="{{ route('instructor.questionary.createProcess') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="group">Grupo</label>
        <select id="group" name="group" class="form-control">
            <option value=""></option>
            @foreach($groups as $group)
                <option value="{{ $group['id'] }}"@if (old('group') == $group['id']) selected @endif>{{ $group['name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="title">Título</label>
        <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
    </div>
    <div class="form-group">
        <label for="description">Descripción</label>
        <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
        <label for="model">Tipo</label>
        <select id="model" name="model" class="form-control">
            <option value=""></option>
            @foreach($models as $model)
                <option value="{{ $model['id'] }}"@if (old('model') == $model['id']) selected @endif>{{ $model['name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Público</label>
        <div class="radio">
            <label><input type="radio" name="public" value="1"@if (old('public') === '1') checked @endif> Sí</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="public" value="0"@if (old('public') === '0') checked @endif> No</label>
        </div>
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