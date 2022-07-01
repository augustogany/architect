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
                Sucursales del Sistema
                  <div class="card-tools">
                      <a href="{{ route('sucursales.create') }}" class="btn btn-primary" title="Crear Nueva Sucursal del Sistema"><i class="fas fa-plus"></i></a>
                  </div>
                </div>

                <div class="card-body">
                    @if(Session::has('notice'))
                    <div class="alert alert-danger">
                      <ul>
                        <li>
                           <p>{{ Session::get('notice')}}</p>
                        </li>
                      </ul>
                    </div>
                    @endif
                    <table class="table table-hover" style="font-size: 10pt">
                        <thead>
                            <tr>
                              <th>Nro.</th>
                              <th>Sucursal</th>
                              <th>Ubicación</th>
                              <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sucursales as $sucursal)
                            <tr>
                              <td>{{$sucursal->id}}</td>
                              <td>{{$sucursal->sucursal}}</td>
                              <td>{{$sucursal->ubicacion}}</td>
                              <td style="width: 120px">
                                <a href="{{route('sucursales.edit',$sucursal->id)}}" title="Editar sucursal" class="btn btn-primary"><i class="fas fa-edit"></i></a>

                                <a data-target="#modal-delete{{$sucursal->id}}" data-toggle="modal" title="Eliminar sucursal" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                              </td>
                            </tr>
                            @include('sucursales.modal')
                            @empty
                            <p style="text-align: center;">No hay registros de sucursales para mostrar.</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection