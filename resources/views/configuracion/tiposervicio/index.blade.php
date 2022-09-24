@extends('layouts.app')
@section('title','Tipos de trámite')

<style>
    table th {
      text-align: center;
    }

    table td {
      text-align: center;
    }
</style>

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
        <i class="fas fa-list"></i>
          Tipos de trámite
            <div class="card-tools">
                <a href="{{ route('tiposervicios.create') }}" class="btn btn-primary" title="Crear nueva gestión"><i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table table-striped" style="font-size: 10pt">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Precio</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @forelse($tiposervicio as $item)
                  <tr>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->precio }}</td>
                    <td>{{ $item->estado }}</td>
                    <td>
                      @can('tiposervicio.edit')
                      <a href="{{ route('tiposervicios.edit', $item->id) }}" title="Editar tipo de servicio." class="btn btn-outline-success"><i class="fas fa-edit"></i></a>
                      @endcan
                      
                      @can('tiposervicio.destroy')
                      {{-- <a data-target="#modal-delete{{ $item->id }}" data-toggle="modal" title="Habilitar/Inhabilitar tipo de servicio." type="button" class="btn btn-danger text-white"><i class="fas fa-trash"></i></a> --}}
                      @endcan
                    </td>
                  </tr>
                @empty
                {{-- <p style="text-align: center;">No hay registros para mostrar.</p> --}}
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
          <div class="card-footer">
            <div class="float-right d-none d-sm-block">
              <b>Version</b> 1.2
            </div>
            <strong>Copyright &copy; 2022 <a href="#">C@DBENI</a>.</strong> Todos los derechos reservados.
          </div>
        </div>
    </div>
  </div>
</div>

@endsection

@push ('styles')
    <link href="{{ asset('theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push ('script')
    <script src="{{asset('theme/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script>
    var categoriageneral;

    $(document).ready(function(){

        $('#dataTable').DataTable({"order":[[0, 'desc']],"language":{"sEmptyTable":"No hay datos disponibles en la tabla","sInfo":"Mostrando _START_ a _END_ de _TOTAL_ entradas","sInfoEmpty":"Mostrando 0 a 0 de 0 entradas","sInfoFiltered":"(Filtrada de _MAX_ entradas totales)","sInfoPostFix":"","sInfoThousands":",","sLengthMenu":"Mostrar _MENU_ entradas","sLoadingRecords":"Cargando...","sProcessing":"Procesando...","sSearch":"Buscar:","sZeroRecords":"No se encontraron registros coincidentes","oPaginate":{"sFirst":"Primero","sLast":"\u00daltimo","sNext":"Siguiente","sPrevious":"Anterior"},"oAria":{"sSortAscending":": Activar para ordenar la columna ascendente","sSortDescending":": Activar para ordenar la columna descendente"}},"columnDefs":[{"targets":"dt-not-orderable","searchable":false,"orderable":false}]});

    });
  </script>
@endpush