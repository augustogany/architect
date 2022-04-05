@extends('layouts.app')
@section('title','Categoría Urbanización')

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
      Categoría Urbanización - Aranceles.
      <div class="card-tools">
        <a href="{{route('print_categoria_urbanizacion')}}" class="btn btn-outline-success" title="Imprimir Categoría Urbanización" target="_blank"><i class="fas fa-file-pdf"></i></a>
      </div>
      </div>

        <div class="card-body">
          <table id="categoriaurbanizacionsTable" class="table table-striped"  style="font-size: 10pt">
            <thead>
              <tr>
                <th>DE:</th>
                <th>A:</th>
                <th>Arancel</th>
                <th>Costo PU.</th>
                <th>Porcentaje CAB.</th>
                <th>Visado $US.</th>
                <th>Visado Bs.</th>
                <th>Acciones</th>
              </tr>
            </thead>
          </table>
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
        $('#categoriaurbanizacionsTable').DataTable({
          "responsive": true, "autoWidth": true,
          //"order": [[ 0, "asc" ]],
          "scrollY":        "280px",
          "scrollCollapse": true,
          processing: true,
          serverSide: true,
          language: {
                 "url": '{!! asset('theme/plugins/datatables/espanol.json') !!}'
                  } ,
          ajax: '{!! route('getCategoriaurbanizacion') !!}',
          columns: [
              { data: 'mt2_inicio', name: 'mt2_inicio' },
              { data: 'mt2_fin', name: 'mt2_fin' },
              { data: 'arancel', name: 'arancel' },
              { data: 'costo_pu', name: 'costo_pu' },
              { data: 'porcentaje_cab', name: 'porcentaje_cab' },
              { data: 'visado_sus', name: 'visado_sus' },
              { data: 'visado_bs', name: 'visado_bs' },
              { data: 'btn_edit'}
          ]
        });
    </script>
@endpush
