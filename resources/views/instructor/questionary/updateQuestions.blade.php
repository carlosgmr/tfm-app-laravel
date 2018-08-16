@extends('layout')
@section('title', 'Modificar preguntas y respuestas')

@section('tools')
<a class="btn btn-sm btn-primary" title="Volver al listado" href="{{ route('instructor.questionary.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
<a class="btn btn-sm btn-primary" title="Volver a detalles" href="{{ route('instructor.questionary.read', ['id' => $id]) }}">
    <i class="fa fa-eye"></i> Volver a detalles
</a>
@endsection

@section('content')
    <div id="questionsContainer"></div>
    <form id="formSave" action="{{ route('instructor.questionary.updateQuestionsProcess', ['id' => $id]) }}" method="post">
        @csrf
        <input type="hidden" id="questions" name="questions" value=""/>
    </form>
@endsection

@section('footer')
<div>
    <button type="button" id="btnAddQuestion" class="btn btn-success" title="Añadir pregunta">
        Añadir pregunta
    </button>
    <button type="button" id="btnSaveQuestions" class="btn btn-primary" title="Guardar">
        Guardar
    </button>
</div>
@endsection

@section('script')
<script type="text/javascript">
    var _QUESTION_TYPE_YESNO = 1;
    var _QUESTION_TYPE_TEST = 2;
    var _MIN_ANSWERS = 2;
    var _MAX_ANSWERS = 4;
    var _MIN_QUESTIONS = 1;
    var _MAX_QUESTIONS = 100;
    var _models = <?php echo json_encode($models); ?>;

    function minimizeQuestion(element)
    {
        var questionIndex = parseInt($(element).attr('data-question-index'), 10);
        var target = '#boxBodyQuestion'+questionIndex;
        var minimized = parseInt($(target).attr('data-minimized'), 10);
        if (minimized === 1) {
            $(target).attr('data-minimized', 0).show();
        } else if (minimized === 0) {
            $(target).attr('data-minimized', 1).hide();
        }
    }

    function deleteQuestion(element)
    {
        var questionIndex = parseInt($(element).attr('data-question-index'), 10);
        var target = '#boxQuestion'+questionIndex;
        var numQuestions = $('#questionsContainer').find('div.box-question').length;

        if (numQuestions > _MIN_QUESTIONS) {
            $(target).remove();
            reIndexQuestions();
        } else {
            alert('Se ha alcanzado el nº mínimo de preguntas: '+_MIN_QUESTIONS);
        }
    }

    function processQuestionModel(element)
    {
        var questionModel = parseInt($(element).val(), 10);
        var questionIndex = parseInt($(element).attr('data-question-index'), 10);

        switch (questionModel) {
            case _QUESTION_TYPE_YESNO:
                var html = getHtmlAnswersYesNoQuestion(questionIndex);
                $('#answersTableBody'+questionIndex).html(html);
                $('#answersTableBody'+questionIndex).find('textarea').prop('readonly', true);
                $('#answersTableBody'+questionIndex).find('button.btn-remove-answer').prop('disabled', true);
                $('#answersContainer'+questionIndex).find('button.btn-add-answer').prop('disabled', true);
                $('#answersContainer'+questionIndex).show();
                break;
            case _QUESTION_TYPE_TEST:
                var html = getHtmlAnswersTestQuestion(questionIndex);
                $('#answersTableBody'+questionIndex).html(html);
                $('#answersContainer'+questionIndex).find('button.btn-add-answer').prop('disabled', false);
                $('#answersContainer'+questionIndex).show();
                break;
            default:
                $('#answersTableBody'+questionIndex).html('');
                $('#answersContainer'+questionIndex).hide();
                break;
        }
    }

    function getHtmlAnswer(questionIndex, answerIndex, data)
    {
        data = typeof data === 'object' ? data : null;
        var statement = data && typeof data['statement'] !== 'undefined' ? data['statement'] : null;
        var correct = data && typeof data['correct'] !== 'undefined' ? data['correct'] : null;
        var html = '';

        html += '<tr>'+
                    '<td>'+answerIndex+'</td>'+
                    '<td><textarea class="form-control answer-statement">'+(statement !== null ? statement : '')+'</textarea></td>'+
                    '<td>'+
                        '<input type="radio" name="correctQuestion'+questionIndex+'" value="'+answerIndex+'"'+(correct === 1 ? ' checked' : '')+'/>'+
                    '</td>'+
                    '<td class="text-center">'+
                        '<button type="button" class="btn btn-default btn-sm btn-remove-answer" title="Eliminar respuesta" onclick="removeAnswer(this)" data-question-index="'+questionIndex+'" data-answer-index="'+answerIndex+'">'+
                            '<i class="fa fa-times"></i>'+
                        '</button>'+
                    '</td>';

        return html;
    }

    function getHtmlAnswersYesNoQuestion(questionIndex)
    {
        var html = getHtmlAnswer(questionIndex, 1, {'statement':'Sí'})+
                getHtmlAnswer(questionIndex, 2, {'statement':'No'});

        return html;
    }

    function getHtmlAnswersTestQuestion(questionIndex)
    {
        var html = getHtmlAnswer(questionIndex, 1)+
                getHtmlAnswer(questionIndex, 2);

        return html;
    }

    function addAnswer(element)
    {
        var questionIndex = parseInt($(element).attr('data-question-index'), 10);
        var answerIndex = $('#answersTableBody'+questionIndex).find('tr').length + 1;

        if (answerIndex <= _MAX_ANSWERS) {
            $('#answersTableBody'+questionIndex).append(getHtmlAnswer(questionIndex, answerIndex));
        } else {
            alert('Se ha alcanzado el nº máximo de respuestas: '+_MAX_ANSWERS);
        }
    }

    function removeAnswer(element)
    {
        var questionIndex = parseInt($(element).attr('data-question-index'), 10);
        var answerIndex = parseInt($(element).attr('data-answer-index'), 10);
        var numAnswers = $('#answersTableBody'+questionIndex).find('tr').length;

        if (numAnswers > _MIN_ANSWERS) {
            $('#answersTableBody'+questionIndex).find('tr:eq('+(answerIndex-1)+')').remove();
            reIndexAnswers(questionIndex);
        } else {
            alert('Se ha alcanzado el nº mínimo de respuestas: '+_MIN_ANSWERS);
        }
    }

    function reIndexAnswers(questionIndex)
    {
        $('#answersTableBody'+questionIndex).find('tr').each(function(i, obj){
            var newIndex = i+1;
            $(obj).find('td:eq(0)').text(newIndex);
            $(obj).find('button.btn-remove-answer').attr('data-answer-index', newIndex);
        });
    }

    function getHtmlBoxHeaderQuestion(questionIndex)
    {
        return  '<div class="box-header with-border">'+
                    '<h3 class="box-title">Pregunta #'+questionIndex+'</h3>'+
                    '<div class="pull-right box-tools">'+
                        '<button type="button" class="btn btn-default btn-sm" title="Minimizar pregunta" onclick="minimizeQuestion(this)" data-question-index="'+questionIndex+'">'+
                            '<i class="fa fa-minus"></i>'+
                        '</button>'+
                        '<button type="button" class="btn btn-default btn-sm" title="Eliminar pregunta" onclick="deleteQuestion(this)" data-question-index="'+questionIndex+'">'+
                            '<i class="fa fa-times"></i>'+
                        '</button>'+
                    '</div>'+
                '</div>';
    }

    function getHtmlSelectModelQuestion(questionIndex, selected)
    {
        var html = '<select class="form-control question-model" onchange="processQuestionModel(this)" data-question-index="'+questionIndex+'"><option value=""></option>';

        for (var i=0; i<_models.length; i++) {
            html += '<option value="'+_models[i]['id']+'"'+(selected === _models[i]['id'] ? ' selected' : '')+'>'+
                        _models[i]['name']+
                    '</option>';
        }

        html += '</select>';
        return html;
    }

    function getHtmlFormQuestion(questionIndex, data)
    {
        data = typeof data === 'object' ? data : null;
        var statement = data && typeof data['statement'] !== 'undefined' ? data['statement'] : null;
        var model = data && typeof data['model'] !== 'undefined' ? data['model'] : null;

        return  '<div class="row">'+
                    '<div class="col-md-6">'+
                        '<div class="form-group">'+
                            '<label>Enunciado</label>'+
                            '<textarea class="form-control question-statement">'+(statement !== null ? statement : '')+'</textarea>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-6">'+
                        '<div class="form-group">'+
                            '<label>Tipo</label>'+
                            getHtmlSelectModelQuestion(questionIndex, model)+
                        '</div>'+
                    '</div>'+
                '</div>';
    }

    function getHtmlAnswersContainer(questionIndex, data)
    {
        data = typeof data === 'object' ? data : null;
        var answers = data && typeof data['answers'] !== 'undefined' ? data['answers'] : [];
        var htmlAnswers = '';

        for (var i=0; i<answers.length; i++) {
            htmlAnswers += getHtmlAnswer(questionIndex, i+1, answers[i]);
        }

        return  '<div id="answersContainer'+questionIndex+'" class="table-responsive" style="display:'+(answers.length > 0 ? 'block': 'none')+'">'+
                    '<p><b>Respuestas</b></p>'+
                    '<table class="table">'+
                        '<thead>'+
                            '<tr>'+
                                '<th class="col-md-1">#</th>'+
                                '<th class="col-md-8">Texto</th>'+
                                '<th class="col-md-2">¿Es correcta?</th>'+
                                '<th class="col-md-1"></th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody id="answersTableBody'+questionIndex+'">'+htmlAnswers+'</tbody>'+
                    '</table>'+
                    '<hr/>'+
                    '<div class="text-right">'+
                        '<button type="button" class="btn btn-default btn-sm btn-add-answer" title="Añadir respuesta" onclick="addAnswer(this)" data-question-index="'+questionIndex+'">'+
                            'Añadir respuesta'+
                        '</button>'+
                    '</div>'+
                '</div>';
    }

    function getHtmlBoxBodyQuestion(questionIndex, data)
    {
        return  '<div id="boxBodyQuestion'+questionIndex+'" class="box-body" data-minimized="0">'+
                    getHtmlFormQuestion(questionIndex, data)+
                    getHtmlAnswersContainer(questionIndex, data)+
                '</div>';
    }

    function getHtmlQuestion(questionIndex, data)
    {
        var html = '';

        html += '<div id="boxQuestion'+questionIndex+'" class="panel box box-default box-question" data-question-index="'+questionIndex+'">'+
                    getHtmlBoxHeaderQuestion(questionIndex)+
                    getHtmlBoxBodyQuestion(questionIndex, data)+
                '</div>';

        return html;
    }

    function addQuestion(data)
    {
        data = typeof data === 'object' ? data : null;
        var model = data && typeof data['model'] !== 'undefined' ? data['model'] : null;
        var numQuestions = $('#questionsContainer').find('div.box-question').length;
        var questionIndex = numQuestions + 1;

        if (numQuestions < _MAX_QUESTIONS) {
            $('#questionsContainer').append(getHtmlQuestion(questionIndex, data));
            
            switch (model) {
                case _QUESTION_TYPE_YESNO:
                    $('#answersTableBody'+questionIndex).find('textarea').prop('readonly', true);
                    $('#answersTableBody'+questionIndex).find('button.btn-remove-answer').prop('disabled', true);
                    $('#answersContainer'+questionIndex).find('button.btn-add-answer').prop('disabled', true);
                    break;
                case _QUESTION_TYPE_TEST:
                    $('#answersContainer'+questionIndex).find('button.btn-add-answer').prop('disabled', false);
                    break;
            }
        } else {
            alert('Se ha alcanzado el nº máximo de preguntas: '+_MAX_QUESTIONS);
        }
    }

    function reIndexQuestions()
    {
        $('#questionsContainer').find('div.box-question').each(function(i, obj){
            var newIndex = i+1;
            $(obj).attr('id', 'boxQuestion'+newIndex);
            $(obj).find('h3.box-title').text('Pregunta #'+newIndex);
            $(obj).find('div[id^="answersContainer"]').attr('id', 'answersContainer'+newIndex);
            $(obj).find('tbody[id^="answersTableBody"]').attr('id', 'answersTableBody'+newIndex);
            $(obj).find('div[id^="boxBodyQuestion"]').attr('id', 'boxBodyQuestion'+newIndex);
            $(obj).find('div[id^="boxQuestion"]').attr('id', 'boxQuestion'+newIndex);
            $(obj).find('input[name^="correctQuestion"]').attr('name', 'correctQuestion'+newIndex);
            $(obj).find('*[data-question-index]').attr('data-question-index', newIndex);
        });
    }

    function saveQuestions()
    {
        var questions = [];

        $('#questionsContainer').find('div.box-question').each(function(i, obj){
            var answers = [];
            var questionIndex = $(obj).attr('data-question-index');

            $('#answersTableBody'+questionIndex).find('tr').each(function(i2, obj2){
                answers.push({
                    'statement': removeInvalidCharacters($(obj2).find('textarea.answer-statement').val()),
                    'correct': parseInt($(obj2).find('input[name="correctQuestion'+questionIndex+'"]:checked').val(), 10) === (i2+1) ? 1 : 0
                });
            });

            questions.push({
                'statement': removeInvalidCharacters($(obj).find('textarea.question-statement').val()),
                'model': parseInt($(obj).find('select.question-model').val(), 10),
                'sort': i+1,
                'answers': answers
            });
        });

        $('#questions').val(escapeJsonString(JSON.stringify(questions)));
        $('#formSave').submit();
    }

    function removeInvalidCharacters(str)
    {
        return str.replace(/\\/g, '')
                .replace(/\'/g, '')
                .replace(/\"/g, '');
    }

    function escapeJsonString(str)
    {
        return str.replace(/\\n/g, "\\\\n");
    }

    var _questions = JSON.parse('<?php echo old('questions', '[]'); ?>');

    $(function(){
        $('#btnAddQuestion').click(function(){
            addQuestion();
        });

        $('#btnSaveQuestions').click(function(){
            saveQuestions();
        });

        if (_questions.length > 0) {
            for (var i=0; i<_questions.length; i++) {
                addQuestion(_questions[i]);
            }
        } else {
            addQuestion();
        }
    });
</script>
@endsection