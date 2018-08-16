@extends('layout')
@section('title', 'Panel de usuario')

@section('content')
    <p>Bienvenido al panel de usuario. Selecciona una opción:</p>
    <p>
        <a href="{{ route('user.group.listing') }}" class="btn btn-default btn-block" style="text-align:left">Grupos</a>
        <a href="{{ route('user.questionary.listing') }}" class="btn btn-default btn-block" style="text-align:left">Exámenes/encuestas</a>
    </p>
@endsection