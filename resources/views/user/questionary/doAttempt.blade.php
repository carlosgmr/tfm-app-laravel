@extends('layout')
@section('title', 'Realizar examen/encuesta')

@section('tools')
<a class="btn btn-sm btn-primary" title="Volver al listado" href="{{ route('user.questionary.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
@endsection

@section('content')
    <form id="formSave" action="{{ route('user.questionary.doAttemptProcess', ['id' => $id]) }}" method="post">
        @csrf
        TODO
    </form>
@endsection