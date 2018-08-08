@extends('layout')
@section('title', 'Inscribir en grupos')

@section('tools')
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('administrator.instructor.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
@endsection

@section('content')
<form id="formGroup" action="{{ route('administrator.instructor.groupProcess', ['id' => $id]) }}" method="post">
    @csrf
    <div class="form-group">
        <label>Grupos</label>
        @foreach($allGroups as $group)
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="group[]" value="{{ $group['id'] }}"@if(in_array($group['id'], old('group', $currentGroups))) checked @endif>
                    {{ $group['name'] }}
                </label>
            </div>
        @endforeach
    </div>
</form>
@endsection

@section('footer')
<div>
    <button type="button" class="btn btn-primary" onclick="$('#formGroup').submit()">Actualizar</button>
</div>
@endsection