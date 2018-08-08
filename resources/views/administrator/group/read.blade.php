@extends('layout')
@section('title', 'Detalle de grupo')

@section('tools')
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('administrator.group.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
@endsection

@section('content')
    @if (!empty($item))
        <div class="row">
            <div class="col-md-4">
                <dl>
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
            <div class="col-md-4">
                <dl>
                    <dt>Instructores inscritos</dt>
                    <dd>
                        @foreach ($instructors as $instructor)
                            <a href="{{ route('administrator.instructor.read', ['id' => $instructor['id']]) }}">
                                {{ trim($instructor['name'].' '.$instructor['surname_1'].' '.$instructor['surname_2']) }}
                            </a><br/>
                        @endforeach
                    </dd>
                </dl>
            </div>
            <div class="col-md-4">
                <dl>
                    <dt>Usuarios inscritos</dt>
                    <dd>
                        @foreach ($users as $user)
                            <a href="{{ route('administrator.user.read', ['id' => $user['id']]) }}">
                                {{ trim($user['name'].' '.$user['surname_1'].' '.$user['surname_2']) }}
                            </a><br/>
                        @endforeach
                    </dd>
                </dl>
            </div>
        </div>
    @else
        No existen datos
    @endif
@endsection

@section('footer')
<div>
    <a class="btn btn-primary" href="{{ route('administrator.group.updateView', ['id' => $id]) }}" title="Modificar">Modificar</a> 
    <a class="btn btn-success" href="{{ route('administrator.group.instructorView', ['id' => $id]) }}" title="Inscribir instructores">Inscribir instructores</a> 
    <a class="btn btn-success" href="{{ route('administrator.group.userView', ['id' => $id]) }}" title="Inscribir usuarios">Inscribir usuarios</a> 
    <a class="btn btn-danger" href="{{ route('administrator.group.deleteView', ['id' => $id]) }}" title="Eliminar">Eliminar</a>
</div>
@endsection