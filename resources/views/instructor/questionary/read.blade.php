@extends('layout')
@section('title', 'Detalle de examen/encuesta')

@section('tools')
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('instructor.questionary.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
@endsection

@section('content')
    @if (!empty($item))
        <dl>
            <dt>ID</dt>
            <dd>{{ $item['id'] }}</dd>
            <dt>Título</dt>
            <dd>{{ $item['title'] }}</dd>
            <dt>Descripción</dt>
            <dd>{{ $item['description'] }}</dd>
            <dt>Tipo</dt>
            <dd>{{ $item['model'] }}</dd>
            <dt>Fecha creación</dt>
            <dd>{{ esDatetime($item['created_at']) }}</dd>
            <dt>Fecha actualización</dt>
            <dd>{{ esDatetime($item['updated_at']) }}</dd>
            <dt>Público</dt>
            <dd>{{ strBool($item['active']) }}</dd>
            <dt>Activo</dt>
            <dd>{{ strBool($item['active']) }}</dd>
        </dl>
    @else
        No existen datos
    @endif
@endsection