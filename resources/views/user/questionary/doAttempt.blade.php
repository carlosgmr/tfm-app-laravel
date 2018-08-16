@extends('layout')
@section('title', 'Realizar examen/encuesta')

@section('tools')
<a class="btn btn-sm btn-primary" title="Volver al listado" href="{{ route('user.questionary.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
@endsection

@section('content')
    @if (!empty($item))
        <div class="panel box box-primary collapsed-box">
            <div class="box-header with-border">
                <h4 class="box-title">Detalles examen/encuesta</h4>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <dl>
                            <dt>Título</dt>
                            <dd>{{ $item['title'] }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-3">
                        <dl>
                            <dt>Descripción</dt>
                            <dd>{{ $item['description'] }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-3">
                        <dl>
                            <dt>Tipo</dt>
                            <dd>{{ $item['model']['name'] }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-3">
                        <dl>
                            <dt>Grupo</dt>
                            <dd><a href="{{ route('user.group.read', ['id' => $item['group']['id']]) }}">{{ $item['group']['name'] }}</a></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">Preguntas</h4>
            </div>
            @if (!empty($item['questions']))
                <form id="formSave" action="{{ route('user.questionary.doAttemptProcess', ['id' => $id]) }}" method="post">
                    <div class="box-body">
                        @csrf
                        <ol>
                            @foreach ($item['questions'] as $indexQuestion => $question)
                                <li>
                                    <div class="form-group">
                                        <label>{{ $question['statement'] }}</label>
                                        <input type="hidden" name="{{ 'questionId'.($indexQuestion+1) }}" value="{{ $question['id'] }}"/>
                                        <ol>
                                            @foreach ($question['answers'] as $answer)
                                                <li>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="{{ 'questionAnswer'.($indexQuestion+1) }}" value="{{ $answer['id'] }}" required @if(old('question'.($indexQuestion+1)) === strval($answer['id'])) checked @endif>
                                                            {{ $answer['statement'] }}
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                </form>
            @else
                <div class="box-body">No existen datos</div>
            @endif
        </div>
    @else
        No existen datos
    @endif
@endsection