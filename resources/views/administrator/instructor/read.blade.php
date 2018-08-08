@extends('layout')
@section('title', 'Detalle de instructor')

@section('tools')
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('administrator.instructor.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
@endsection

@section('content')
    @if (!empty($item))
        <dl>
            <dt>ID</dt>
            <dd>{{ $item['id'] }}</dd>
            <dt>Email</dt>
            <dd>{{ $item['email'] }}</dd>
            <dt>Nombre</dt>
            <dd>{{ $item['name'] }}</dd>
            <dt>1º apellido</dt>
            <dd>{{ $item['surname_1'] }}</dd>
            <dt>2º apellido</dt>
            <dd>{{ $item['surname_2'] }}</dd>
            <dt>Fecha creación</dt>
            <dd>{{ esDatetime($item['created_at']) }}</dd>
            <dt>Fecha actualización</dt>
            <dd>{{ esDatetime($item['updated_at']) }}</dd>
            <dt>Activo</dt>
            <dd>{{ strBool($item['active']) }}</dd>
            <dt>Grupos a los que pertenece</dt>
            <dd>
                @foreach ($groups as $group)
                    <a href="{{ route('administrator.group.read', ['id' => $group['id']]) }}">{{ $group['name'] }}</a><br/>
                @endforeach
            </dd>
        </dl>
    @else
        No existen datos
    @endif
@endsection

@section('footer')
<div>
    <a class="btn btn-primary" href="{{ route('administrator.instructor.updateView', ['id' => $id]) }}" title="Modificar">Modificar</a> 
    <a class="btn btn-success" href="{{ route('administrator.instructor.groupView', ['id' => $id]) }}" title="Inscribir en grupos">Inscribir en grupos</a> 
    <a class="btn btn-danger" href="{{ route('administrator.instructor.deleteView', ['id' => $id]) }}" title="Eliminar">Eliminar</a>
</div>
@endsection