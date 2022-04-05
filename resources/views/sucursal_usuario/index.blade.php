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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Asignación de Sucursales a Usuarios
                    <div class="card-tools">
                        <a href="{{ route('sucursales_usuarios.create') }}" class="btn btn-primary" title="Crear Asignación de sucursal"><i class="fas fa-plus"></i></button></a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-hover" style="font-size: 10pt">
                        <thead>
                            <tr>
                              <th>Nro.</th>
                              <th>Sucursal</th>
                              <th>Usuario</th>
                              <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sucursal_usuarios as $sucursales_usuario)
                            <tr>
                              <td>{{$sucursales_usuario->id}}</td>
                              <td>{{$sucursales_usuario->sucursal}}</td>
                              <td>{{$sucursales_usuario->name}}</td>
                              <td>
                                 <a data-target="#modal-delete{{$sucursales_usuario->id}}" data-toggle="modal" title="Eliminar asignación de sucursal" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                              </td>
                            </tr>
                            @include("sucursal_usuario.modal")
                            @empty
                            <p style="text-align: center;">No hay asignación de sucursales para mostrar.</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection