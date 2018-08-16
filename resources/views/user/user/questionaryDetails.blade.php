@extends('layout')
@section('title', 'Detalles realización examen/encuesta')

@section('tools')
<a class="btn btn-sm btn-primary" title="Volver al listado" href="{{ route('user.questionary.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
@endsection

@section('content')
    @if (!empty($item))
        <div class="row">
            <div class="col-md-4">
                <div class="panel box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Examen/encuesta</h4>
                    </div>
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt>ID</dt>
                            <dd>{{ $item['questionary']['id'] }}</dd>
                            <dt>Grupo</dt>
                            <dd>
                                <a href="{{ route('user.group.read', ['id' => $item['questionary']['group']['id']]) }}">
                                    {{ $item['questionary']['group']['name'] }}
                                </a>
                            </dd>
                            <dt>Título</dt>
                            <dd>{{ $item['questionary']['title'] }}</dd>
                            <dt>Descripción</dt>
                            <dd>{{ $item['questionary']['description'] }}</dd>
                            <dt>Tipo</dt>
                            <dd>{{ $item['questionary']['model']['name'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Resultado</h4>
                    </div>
                    <div class="box-body">
                        @if ($item['last_date'])
                            <ol>
                                @foreach ($item['questions'] as $question)
                                    <li>
                                        <b>{{ $question['statement'] }}</b>
                                        <ol>
                                            @foreach ($question['answers'] as $answer)
                                                <li>
                                                    {{ $answer['statement'] }} 
                                                    @if ($question['registry']['answer'] === $answer['id'])
                                                        @if ($answer['correct'])
                                                            <span class="label label-success" title="Respuesta correcta"><i class="fa fa-check"></i></span>
                                                        @else
                                                            <span class="label label-danger" title="Respuesta incorrecta"><i class="fa fa-remove"></i></span>
                                                        @endif
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ol>
                                    </li>
                                @endforeach
                            </ol>
                            <hr/>
                            <p><b>Fecha última respuesta guardada: </b>{{ esDatetime($item['last_date']) }}</p>
                        @else
                            <div class="alert alert-warning">El usuario aún no ha realizado el examen/encuesta</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        No existen datos
    @endif
@endsection