@extends('layout')
@section('title', 'Examen/encuesta')

@section('tools')
<a class="btn btn-sm btn-primary" title="Volver al listado" href="{{ route('instructor.questionary.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="panel box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">Detalles</h4>
                </div>
                <div class="box-body">
                    @if (!empty($item))
                        <dl class="dl-horizontal">
                            <dt>ID</dt>
                            <dd>{{ $item['id'] }}</dd>
                            <dt>Grupo</dt>
                            <dd>
                                <a href="{{ route('instructor.group.read', ['id' => $item['group']['id']]) }}">
                                    {{ $item['group']['name'] }}
                                </a>
                            </dd>
                            <dt>Título</dt>
                            <dd>{{ $item['title'] }}</dd>
                            <dt>Descripción</dt>
                            <dd>{{ $item['description'] }}</dd>
                            <dt>Tipo</dt>
                            <dd>{{ $item['model']['name'] }}</dd>
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
                </div>
                <div class="box-footer">
                    <a class="btn btn-primary" href="{{ route('instructor.questionary.updateView', ['id' => $id]) }}" title="Modificar">Modificar</a> 
                    <a class="btn btn-danger" href="{{ route('instructor.questionary.deleteView', ['id' => $id]) }}" title="Eliminar">Eliminar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">Preguntas y respuestas</h4>
                </div>
                <div class="box-body">
                    @if (empty($item['questions']))
                        <a class="btn btn-success" href="{{ route('instructor.questionary.updateQuestionsView', ['id' => $id]) }}" title="Añadir">Añadir</a> 
                    @else
                        <ol>
                            @foreach ($item['questions'] as $question)
                                <li>
                                    <b><?php echo nl2brV2($question['statement']); ?></b>
                                    <ol>
                                        @foreach ($question['answers'] as $answer)
                                            <li>
                                                <?php echo nl2brV2($answer['statement']); ?> 
                                                @if ($answer['correct'])
                                                <span class="label label-success" title="Respuesta correcta"><i class="fa fa-check"></i></span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ol>
                                </li>
                            @endforeach
                        </ol>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">Usuarios que lo han realizado</h4>
                </div>
                <div class="box-body">
                    @if (count($item['users']) > 0)
                        @foreach ($item['users'] as $user)
                            <a href="{{ route('instructor.user.questionaryDetails', ['idUser' => $user['id'], 'idQuestionary' => $id]) }}">
                                {{ trim($user['name'].' '.$user['surname_1'].' '.$user['surname_2']) }}
                            </a>
                        @endforeach
                    @else
                        <div>No existen datos</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection