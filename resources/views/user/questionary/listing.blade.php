@extends('layout')
@section('title', 'Listado de exámenes/encuestas')

@section('content')
    @if (!empty($items))
        <div class="row">
            <div class="col-md-6">
                <div class="panel box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Exámenes/encuestas pendientes</h4>
                    </div>
                    <div class="box-body">
                        @if (!empty($items['not_done']))
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Título</th>
                                            <th>Descripción</th>
                                            <th>Tipo</th>
                                            <th>Grupo</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items['not_done'] as $item)
                                            <tr>
                                                <td>{{ $item['id'] }}</td>
                                                <td>{{ $item['title'] }}</td>
                                                <td>{{ $item['description'] }}</td>
                                                <td>{{ $item['model'] }}</td>
                                                <td>
                                                    <a href="{{ route('user.group.read', ['id' => $item['group']['id']]) }}">
                                                        {{ $item['group']['name'] }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-xs btn-success" title="Realizar examen/encuesta" href="{{ route('user.questionary.doAttemptView', ['id' => $item['id']]) }}">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning">No existen datos</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Exámenes/encuestas realizados</h4>
                    </div>
                    <div class="box-body">
                        @if (!empty($items['done']))
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Título</th>
                                            <th>Descripción</th>
                                            <th>Tipo</th>
                                            <th>Grupo</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items['done'] as $item)
                                            <tr>
                                                <td>{{ $item['id'] }}</td>
                                                <td>{{ $item['title'] }}</td>
                                                <td>{{ $item['description'] }}</td>
                                                <td>{{ $item['model'] }}</td>
                                                <td>
                                                    <a href="{{ route('user.group.read', ['id' => $item['group']['id']]) }}">
                                                        {{ $item['group']['name'] }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-xs btn-warning" title="Ver detalles realización examen/encuesta" href="{{ route('user.user.questionaryDetails', ['id' => $item['id']]) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning">No existen datos</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        No existen datos
    @endif
@endsection