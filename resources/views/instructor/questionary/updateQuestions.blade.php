@extends('layout')
@section('title', 'Modificar preguntas y respuestas')

@section('tools')
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('instructor.questionary.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('instructor.questionary.read', ['id' => $id]) }}">
    <i class="fa fa-eye"></i> Volver a detalles
</a>
@endsection

@section('content')
<form id="formUpdate" action="{{ route('instructor.questionary.updateQuestionsProcess', ['id' => $id]) }}" method="post">
    @csrf
    <div id="boxQuestion" class="panel box box-default" data-id-question="">
        <div class="box-header with-border">
            <h3 class="box-title">Pregunta #X</h3>
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-default btn-sm" title="Minimizar pregunta" onclick="minimizeQuestion('#boxBodyQuestion')">
                    <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-default btn-sm" title="Eliminar pregunta" onclick="deleteQuestion('#boxQuestion')">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <div id="boxBodyQuestion" class="box-body" data-minimized="0">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="statement">Enunciado</label>
                        <textarea id="statement" name="statement" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="model">Tipo</label>
                        <select id="model" name="model" class="form-control">
                            <option value=""></option>
                            @foreach ($models as $model)
                                <option value="{{ $model['id'] }}">{{ $model['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div id="answersContainer" class="table-responsive">
                <p><b>Respuestas</b></p>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-md-2">#</th>
                            <th class="col-md-8">Texto</th>
                            <th class="col-md-2">¿Es correcta?</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                <hr/>
                <div class="text-right">
                    <button type="button" id="btnAddAnswers" class="btn btn-default btn-sm" title="Añadir respuesta">
                        Añadir respuesta
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer')
<div>
    <button type="button" id="btnAddQuestion" class="btn btn-success" title="Añadir pregunta">
        Añadir pregunta
    </button>
    <button type="button" class="btn btn-primary" onclick="$('#formUpdate').submit()">Modificar</button>
</div>
@endsection

@section('script')
<script type="text/javascript">
    var _toDelete = [];

    function minimizeQuestion(target)
    {
        var minimized = parseInt($(target).attr('data-minimized'), 10);
        if (minimized === 1) {
            $(target).attr('data-minimized', 0).show();
        } else if (minimized === 0) {
            $(target).attr('data-minimized', 1).hide();
        }
    }

    function deleteQuestion(target)
    {
        var strIdQuestion = $(target).attr('data-id-question');
        var idQuestion = (typeof strIdQuestion !== 'undefined' && strIdQuestion !== '' ? parseInt(strIdQuestion, 10) : null);

        if (idQuestion) {
            _toDelete.push(idQuestion);
        }

        $(target).remove();
    }

    $(function(){
        
    });
</script>
@endsection