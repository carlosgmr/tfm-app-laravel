@extends('layout')
@section('title', 'Listado de grupos')

@section('content')
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
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
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['description'] }}</td>
                        <td>{{ esDatetime($item['created_at']) }}</td>
                        <td>{{ esDatetime($item['updated_at']) }}</td>
                        <td>{{ strBool($item['active']) }}</td>
                        <td>
                            <a class="btn btn-xs btn-warning" title="Ver detalles" href="{{ route('instructor.group.read', ['id' => $item['id']]) }}">
                                <i class="fa fa-eye"></i>
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