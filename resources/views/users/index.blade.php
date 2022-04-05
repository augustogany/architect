@extends('layouts.app')
<style>
    table th {
      text-align: center;
    }

    table td {
      text-align: center;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                Usuarios del Sistema
                </div>

                <div class="card-body">
                    <table class="table table-hover" style="font-size: 10pt">
                        <thead>
                            <tr>
                                <th>Cod. Registro</th>
                                <th>Nombre usuario</th>
                                <th>Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>

                                <td style="width: 120pt">
                                    @can('users.show')
                                    <a href="{{ route('users.show', $user->id) }}" title="Ver usuario" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                    @endcan

                                    @can('users.edit')
                                    <a href="{{ route('users.edit', $user->id) }}" title="Editar usuario" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    @endcan

                                    @can('users.destroy')
                                    <a data-target="#modal-delete{{$user->id}}" data-toggle="modal" title="Eliminar usuario" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                            @include('users.modal')
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection