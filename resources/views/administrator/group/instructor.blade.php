@extends('layout')
@section('title', 'Inscribir instructores')

@section('tools')
<a class="btn btn-sm btn-primary" title="Volver al listado" href="{{ route('administrator.group.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a> 
<a class="btn btn-sm btn-primary" title="Volver a detalles" href="{{ route('administrator.group.read', ['id' => $id]) }}">
    <i class="fa fa-eye"></i> Volver a detalles
</a>
@endsection

@section('content')
<form id="formInstructor" action="{{ route('administrator.group.instructorProcess', ['id' => $id]) }}" method="post">
    @csrf
    <div class="form-group">
        <label>Instructores</label>
        @foreach($allInstructors as $instructor)
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="instructor[]" value="{{ $instructor['id'] }}"@if(in_array($instructor['id'], old('instructor', $currentInstructors))) checked @endif>
                    {{ trim($instructor['name'].' '.$instructor['surname_1'].' '.$instructor['surname_2']) }}
                </label>
            </div>
        @endforeach
    </div>
</form>
@endsection

@section('footer')
<div>
    <button type="button" class="btn btn-primary" onclick="$('#formInstructor').submit()">Actualizar</button>
</div>
@endsection