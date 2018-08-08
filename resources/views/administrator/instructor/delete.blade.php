@extends('layout')
@section('title', 'Eliminar instructor')

@section('tools')
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('administrator.instructor.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a> 
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('administrator.instructor.read', ['id' => $id]) }}">
    <i class="fa fa-eye"></i> Volver a detalles
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
        </dl>
    @else
        No existen datos
    @endif
@endsection

@section('footer')
<form action="{{ route('administrator.instructor.deleteProcess', ['id' => $id]) }}" method="post">
    @csrf
    <button type="submit" class="btn btn-danger" title="Confirmar borrado">Confirmar borrado</button>
</form>
@endsection