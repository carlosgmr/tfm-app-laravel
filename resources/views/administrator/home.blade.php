@extends('layout')
@section('title', 'Panel de administrador')

@section('content')
    <p>Bienvenido al panel de administrador. Selecciona una opción:</p>
    <p>
        <a href="{{ route('administrator.administrator.listing') }}" class="btn btn-default btn-block" style="text-align:left">Administradores</a>
        <a href="{{ route('administrator.instructor.listing') }}" class="btn btn-default btn-block" style="text-align:left">Instructores</a>
        <a href="{{ route('administrator.user.listing') }}" class="btn btn-default btn-block" style="text-align:left">Usuarios</a>
        <a href="{{ route('administrator.group.listing') }}" class="btn btn-default btn-block" style="text-align:left">Grupos</a>
    </p>
@endsection