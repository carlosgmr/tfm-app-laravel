@extends('layout')
@section('title', 'Detalle de usuario')

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
                    @if (in_array($group['id'], $validGroups))
                        <a href="{{ route('instructor.group.read', ['id' => $group['id']]) }}">{{ $group['name'] }}</a><br/>
                    @endif
                @endforeach
            </dd>
        </dl>
    @else
        No existen datos
    @endif
@endsection