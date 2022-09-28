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
                    Roles del Sistema
                    <div class="card-tools">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary" title="Crear Nuevo Rol del Sistema"><i class="fas fa-plus"></i></a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-hover" style="font-size: 10pt">
                        <thead>
                            <tr>
                                <th>Cod. Registro</th>
                                <th>Nombre de Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>

                                <td style="width: 120pt">
                                    @can('roles.show')
                                    <a href="{{ route('roles.show', $role->id) }}" title="Ver Rol" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a>
                                    @endcan

                                    @can('roles.edit')
                                    <a href="{{ route('roles.edit', $role->id) }}" title="Editar Rol" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    @endcan

                                    @can('roles.destroy')
                                    <a data-target="#modal-delete{{$role->id}}" data-toggle="modal" title="Eliminar usuario" type="button" class="btn btn-danger btn-sm text-white"><i class="fas fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                            @include('roles.modal')
                            @endforeach
                        </tbody>
                    </table>
                    {{ $roles->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection