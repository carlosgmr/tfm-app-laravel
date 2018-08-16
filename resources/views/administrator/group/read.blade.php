@extends('layout')
@section('title', 'Detalle de grupo')

@section('tools')
<a class="btn btn-sm btn-primary" title="Volver al listado" href="{{ route('administrator.group.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
@endsection

@section('content')
    @if (!empty($item))
        <div class="row">
            <div class="col-md-4">
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
                    <div class="box-footer">
                        <a class="btn btn-primary" href="{{ route('administrator.group.updateView', ['id' => $id]) }}" title="Modificar">Modificar</a> 
                        <a class="btn btn-danger" href="{{ route('administrator.group.deleteView', ['id' => $id]) }}" title="Eliminar">Eliminar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Instructores inscritos</h4>
                    </div>
                    <div class="box-body">
                        @if (empty($instructors))
                            No existen datos
                        @endif
                        @foreach ($instructors as $instructor)
                            <a href="{{ route('administrator.instructor.read', ['id' => $instructor['id']]) }}">
                                {{ trim($instructor['name'].' '.$instructor['surname_1'].' '.$instructor['surname_2']) }}
                            </a><br/>
                        @endforeach
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-success" href="{{ route('administrator.group.instructorView', ['id' => $id]) }}" title="Inscribir instructores">Inscribir instructores</a> 
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Usuarios inscritos</h4>
                    </div>
                    <div class="box-body">
                        @if (empty($users))
                            No existen datos
                        @endif
                        @foreach ($users as $user)
                            <a href="{{ route('administrator.user.read', ['id' => $user['id']]) }}">
                                {{ trim($user['name'].' '.$user['surname_1'].' '.$user['surname_2']) }}
                            </a><br/>
                        @endforeach
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-success" href="{{ route('administrator.group.userView', ['id' => $id]) }}" title="Inscribir usuarios">Inscribir usuarios</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        No existen datos
    @endif
@endsection