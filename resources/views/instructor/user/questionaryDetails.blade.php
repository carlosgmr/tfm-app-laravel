@extends('layout')
@section('title', 'Detalles realización examen/encuesta')

@section('tools')
<a class="btn btn-sm btn-primary" title="Volver a detalles examen" href="{{ route('instructor.questionary.read', ['id' => $idQuestionary]) }}">
    <i class="fa fa-eye"></i> Volver a detalles examen
</a>
<a class="btn btn-sm btn-primary" title="Volver a detalles usuario" href="{{ route('instructor.user.read', ['id' => $idUser]) }}">
    <i class="fa fa-eye"></i> Volver a detalles usuario
</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="panel box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">Identificación</h4>
                </div>
                <div class="box-body">
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">Resultado</h4>
                </div>
                <div class="box-body">
                </div>
            </div>
        </div>
    </div>
@endsection