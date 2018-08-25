@extends('layout')
@section('title', 'Eliminar examen/encuesta')

@section('tools')
<a class="btn btn-sm btn-primary" title="Volver al listado" href="{{ route('instructor.questionary.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
<a class="btn btn-sm btn-primary" title="Volver a detalles" href="{{ route('instructor.questionary.read', ['id' => $id]) }}">
    <i class="fa fa-eye"></i> Volver a detalles
</a>
@endsection

@section('content')
    @if (!empty($item))
        <dl class="dl-horizontal">
            <dt>ID</dt>
            <dd>{{ $item['id'] }}</dd>
            @if (!empty($group))
                <dt>Grupo</dt>
                <dd>
                    <a href="{{ route('instructor.group.read', ['id' => $group['id']]) }}">
                        {{ $group['name'] }}
                    </a>
                </dd>
            @endif
            <dt>Título</dt>
            <dd>{{ $item['title'] }}</dd>
            <dt>Descripción</dt>
            <dd>{{ $item['description'] }}</dd>
            @if (!empty($model))
                <dt>Tipo</dt>
                <dd>{{ $model['name'] }}</dd>
            @endif
            <dt>Fecha creación</dt>
            <dd>{{ esDatetime($item['created_at']) }}</dd>
            <dt>Fecha actualización</dt>
            <dd>{{ esDatetime($item['updated_at']) }}</dd>
            <dt>Público</dt>
            <dd>{{ strBool($item['public']) }}</dd>
            <dt>Activo</dt>
            <dd>{{ strBool($item['active']) }}</dd>
        </dl>
    @else
        No existen datos
    @endif
@endsection

@section('footer')
<form action="{{ route('instructor.questionary.deleteProcess', ['id' => $id]) }}" method="post">
    @csrf
    <button type="submit" class="btn btn-danger" title="Confirmar borrado">Confirmar borrado</button>
</form>
@endsection