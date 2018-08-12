@extends('layout')
@section('title', 'Detalle de grupo')

@section('tools')
<a class="btn btn-sm btn-primary" title="Crear" href="{{ route('instructor.group.listing') }}">
    <i class="fa fa-arrow-left"></i> Volver al listado
</a>
@endsection

@section('content')
    @if (!empty($item))
        <div class="row">
            <div class="col-md-3">
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
            <div class="col-md-3">
                <dl>
                    <dt>Instructores inscritos</dt>
                    <dd>
                        @foreach ($instructors as $instructor)
                            <a href="{{ route('instructor.instructor.read', ['id' => $instructor['id']]) }}">
                                {{ trim($instructor['name'].' '.$instructor['surname_1'].' '.$instructor['surname_2']) }}
                            </a><br/>
                        @endforeach
                    </dd>
                </dl>
            </div>
            <div class="col-md-3">
                <dl>
                    <dt>Usuarios inscritos</dt>
                    <dd>
                        @foreach ($users as $user)
                            <a href="{{ route('instructor.user.read', ['id' => $user['id']]) }}">
                                {{ trim($user['name'].' '.$user['surname_1'].' '.$user['surname_2']) }}
                            </a><br/>
                        @endforeach
                    </dd>
                </dl>
            </div>
            <div class="col-md-3">
                <dl>
                    <dt>Exámenes/Encuestas disponibles</dt>
                    <dd>
                        @foreach ($questionarys as $questionary)
                            <a href="{{ route('instructor.questionary.read', ['id' => $questionary['id']]) }}">
                                {{ $questionary['title'] }}
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
    <a class="btn btn-primary" href="{{ route('instructor.questionary.createView') }}" title="Crear examen">Crear examen</a> 
</div>
@endsection