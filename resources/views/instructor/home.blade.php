@extends('layout')
@section('title', 'Panel de instructor')

@section('content')
    <p>Bienvenido al panel de instructor. Selecciona una opción:</p>
    <p>
        <a href="{{ route('instructor.group.listing') }}" class="btn btn-default btn-block" style="text-align:left">Grupos</a>
        <a href="{{ route('instructor.questionary.listing') }}" class="btn btn-default btn-block" style="text-align:left">Exámenes/encuestas</a>
    </p>
@endsection