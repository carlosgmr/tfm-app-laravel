@extends('layout')
@section('title', 'Detalle de grupo')

@section('tools')
<a class="btn btn-sm btn-primary" title="Volver al listado" href="{{ route('user.group.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
@endsection

@section('content')
    @if (!empty($item))
        <div class="row">
            <div class="col-md-3">
                <div class="panel box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Datos</h4>
                    </div>
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt>ID</dt>
                            <dd>{{ $item['id'] }}</dd>
                            <dt>Nombre</dt>
                            <dd>{{ $item['name'] }}</dd>
                            <dt>Descripción</dt>
                            <dd>{{ $item['description'] }}</dd>
                            <dt>Fecha creación</dt>
                            <dd>{{ esDatetime($item['created_at']) }}</dd>
                            <dt>Fecha actualización</dt>
                            <dd>{{ esDatetime($item['updated_at']) }}</dd>
                            <dt>Activo</dt>
                            <dd>{{ strBool($item['active']) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Instructores inscritos</h4>
                    </div>
                    <div class="box-body">
                        @foreach ($instructors as $instructor)
                            <a href="{{ route('user.instructor.read', ['id' => $instructor['id']]) }}">
                                {{ trim($instructor['name'].' '.$instructor['surname_1'].' '.$instructor['surname_2']) }}
                            </a><br/>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Usuarios inscritos</h4>
                    </div>
                    <div class="box-body">
                        @foreach ($users as $user)
                            <a href="{{ route('user.user.read', ['id' => $user['id']]) }}">
                                {{ trim($user['name'].' '.$user['surname_1'].' '.$user['surname_2']) }}
                            </a><br/>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Exámenes/encuestas pendientes</h4>
                    </div>
                    <div class="box-body">
                        @if (!empty($questionarys['not_done']))
                            @foreach ($questionarys['not_done'] as $questionary)
                                <a href="{{ route('user.questionary.doAttemptView', ['id' => $questionary['id']]) }}">
                                    {{ $questionary['title'] }}
                                </a><br/>
                            @endforeach
                        @else
                            <div class="alert alert-warning">No existen datos</div>
                        @endif
                    </div>
                </div>

                <div class="panel box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Exámenes/encuestas realizados</h4>
                    </div>
                    <div class="box-body">
                        @if (!empty($questionarys['done']))
                            @foreach ($questionarys['done'] as $questionary)
                                <a href="{{ route('user.user.questionaryDetails', ['id' => $questionary['id']]) }}">
                                    {{ $questionary['title'] }}
                                </a><br/>
                            @endforeach
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