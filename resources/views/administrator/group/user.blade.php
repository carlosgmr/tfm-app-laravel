@extends('layout')
@section('title', 'Inscribir usuarios')

@section('tools')
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('administrator.group.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a> 
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('administrator.group.read', ['id' => $id]) }}">
    <i class="fa fa-eye"></i> Volver a detalles
</a>
@endsection

@section('content')
<form id="formUser" action="{{ route('administrator.group.userProcess', ['id' => $id]) }}" method="post">
    @csrf
    <div class="form-group">
        <label>Instructores</label>
        @foreach($allUsers as $user)
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="user[]" value="{{ $user['id'] }}"@if(in_array($user['id'], old('user', $currentUsers))) checked @endif>
                    {{ trim($user['name'].' '.$user['surname_1'].' '.$user['surname_2']) }}
                </label>
            </div>
        @endforeach
    </div>
</form>
@endsection

@section('footer')
<div>
    <button type="button" class="btn btn-primary" onclick="$('#formUser').submit()">Actualizar</button>
</div>
@endsection