@extends('layout')
@section('title', 'Eliminar administrador')

@section('tools')
<a class="btn btn-sm btn-primary" title="Volver al listado" href="{{ route('administrator.administrator.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a> 
<a class="btn btn-sm btn-primary" title="Volver a detalles" href="{{ route('administrator.administrator.read', ['id' => $id]) }}">
    <i class="fa fa-eye"></i> Volver a detalles
</a>
@endsection

@section('content')
    @if (!empty($item))
        <dl class="dl-horizontal">
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
<form action="{{ route('administrator.administrator.deleteProcess', ['id' => $id]) }}" method="post">
    @csrf
    <button type="submit" class="btn btn-danger" title="Confirmar borrado">Confirmar borrado</button>
</form>
@endsection