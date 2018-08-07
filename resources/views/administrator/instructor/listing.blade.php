@extends('layout')
@section('title', 'Listado de instructores')

@section('tools')
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('administrator.instructor.createView') }}">
    <i class="fa fa-plus"></i> Crear
</a>
@endsection

@section('content')
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Nombre</th>
                <th>1º apellido</th>
                <th>2º apellido</th>
                <th>Fecha creación</th>
                <th>Fecha actualización</th>
                <th>Activo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (count($items) > 0)
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item['email'] }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['surname_1'] }}</td>
                        <td>{{ $item['surname_2'] }}</td>
                        <td>{{ esDatetime($item['created_at']) }}</td>
                        <td>{{ esDatetime($item['updated_at']) }}</td>
                        <td>{{ strBool($item['active']) }}</td>
                        <td>
                            <a class="btn btn-xs btn-warning" title="Ver detalles" href="{{ route('administrator.instructor.read', ['id' => $item['id']]) }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-success" title="Editar" href="{{ route('administrator.instructor.updateView', ['id' => $item['id']]) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a class="btn btn-xs btn-danger" title="Eliminar" href="{{ route('administrator.instructor.deleteView', ['id' => $item['id']]) }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9" class="text-center">No existen datos</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection