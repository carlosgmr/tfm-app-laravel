@extends('layout')
@section('title', 'Detalle de usuario')

@section('content')
    @if (!empty($item))
        <div class="row">
            <div class="col-md-4">
                <dl>
                    <dt>ID</dt>
                    <dd>{{ $item['id'] }}</dd>
                    <dt>Email</dt>
                    <dd>{{ $item['email'] }}</dd>
                    <dt>Nombre</dt>
                    <dd>{{ $item['name'] }}</dd>
                    <dt>1º apellido</dt>
                    <dd>{{ $item['surname_1'] }}</dd>
                    <dt>2º apellido</dt>
                    <dd>{{ $item['surname_2'] }}</dd>
                    <dt>Fecha creación</dt>
                    <dd>{{ esDatetime($item['created_at']) }}</dd>
                    <dt>Fecha actualización</dt>
                    <dd>{{ esDatetime($item['updated_at']) }}</dd>
                    <dt>Activo</dt>
                    <dd>{{ strBool($item['active']) }}</dd>
                </dl>
            </div>
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Grupos a los que pertenece</th>
                                <th>Exámenes/encuestas realizados</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                                @if (in_array($group['id'], $validGroups))
                                    <tr>
                                        <td>
                                            <a href="{{ route('instructor.group.read', ['id' => $group['id']]) }}">{{ $group['name'] }}</a>
                                        </td>
                                        <td>
                                            @if (isset($questionarys[$group['id']]))
                                                @foreach ($questionarys[$group['id']] as $questionary)
                                                    <a href="{{ route('instructor.user.questionaryDetails', ['idUser' => $id, 'idQuestionary' => $questionary['id']]) }}">
                                                        {{ $questionary['title'] }}
                                                    </a><br/>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        No existen datos
    @endif
@endsection