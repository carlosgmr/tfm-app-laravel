@extends('layout')
@section('title', 'Listado de exámenes/encuestas')

@section('tools')
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('instructor.questionary.createView') }}">
    <i class="fa fa-plus"></i> Crear
</a>
@endsection

@section('content')
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Tipo</th>
                <th>Grupo</th>
                <th>Fecha creación</th>
                <th>Fecha actualización</th>
                <th>Público</th>
                <th>Activo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (count($items) > 0)
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item['title'] }}</td>
                        <td>{{ $item['description'] }}</td>
                        <td>{{ $item['model']['name'] }}</td>
                        <td>
                            <a href="{{ route('instructor.group.read', ['id' => $item['group']['id']]) }}">
                                {{ $item['group']['name'] }}
                            </a>
                        </td>
                        <td>{{ esDatetime($item['created_at']) }}</td>
                        <td>{{ esDatetime($item['updated_at']) }}</td>
                        <td>{{ strBool($item['public']) }}</td>
                        <td>{{ strBool($item['active']) }}</td>
                        <td>
                            <a class="btn btn-xs btn-warning" title="Ver detalles" href="{{ route('instructor.questionary.read', ['id' => $item['id']]) }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-success" title="Modificar examen/encuesta" href="{{ route('instructor.questionary.updateView', ['id' => $item['id']]) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a class="btn btn-xs btn-info" title="Modificar preguntas y respuestas" href="{{ route('instructor.questionary.updateQuestionsView', ['id' => $item['id']]) }}">
                                <i class="fa fa-check-square-o"></i>
                            </a>
                            <a class="btn btn-xs btn-danger" title="Eliminar" href="{{ route('instructor.questionary.deleteView', ['id' => $item['id']]) }}">
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