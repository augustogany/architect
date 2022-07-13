@extends('layouts.app')
@section('title','Lista de Tipos de Pago')

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
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-th-list"></i>
          Lista de Tipos de Pagos
            <div class="card-tools">
              @can('tipopago.create')
              <a href="{{ route('tipopagos.create') }}" class="btn btn-outline-success btn-lg" title="Crear nuevo tipo de pago."><i class="fas fa-plus"></i></a>
              @endcan
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
          <table id="tipopagoTable" class="table table-striped"  style="font-size: 9pt">
            <thead>
              <tr>
                <th></th>
                <th>Tipo de pago</th>
                <th>Sucursal</th>
                <th>Gestión</th>
                <th>Monto</th>
                <th>Descuento %.</th>
                <th>Descuento Bs.</th>
                <th>Cantidad cuotas</th>
                <th>Estado</th>
                <th></th>
              </tr>
            </thead>
          </table>
        </div>
        <div class="card-footer">
          <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.2
          </div>
          <strong>Copyright &copy; 2022 <a href="#">C@DBENI</a>.</strong>Todos los derechos reservados.
        </div>
      </div>

    </div>
  </div>
</div>

@endsection

@push ('styles')
    <link href="{{ asset('theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"> --}}
@endpush

@push ('script')
    <script src="{{asset('theme/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

    {{-- <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script> --}}


    <script>
      $(document).ready(function() {
        //$.noConflict();
        $('#tipopagoTable').DataTable({
          "responsive": true, "autoWidth": true,
          "order": [[ 0, "desc" ]],
          // "scrollY":        "280px",
          "scrollCollapse": true,
          //"pagingType": "full_numbers",
          processing: true,
          serverSide: true,
          language: {
                 "url": '{!! asset('theme/plugins/datatables/espanol.json') !!}'
                  } ,
          ajax: '{!! route('gettipopago') !!}',
          columns: [
              { data: 'id', name: 'id' },
              { data: 'nombrepago', name: 'nombrepago' },
              { data: 'sucursal.sucursal', name: 'sucursal.sucursal' },
              { data: 'gestion', name: 'gestion' },
              { data: 'monto', name: 'monto' },
              { data: 'descuentoporcentaje', name: 'descuentoporcentaje' },
              { data: 'descuentobs', name: 'descuentobs' },
              { data: 'cuotas', name: 'cuotas' },
              { data: "condicion_aux",
              render: function (data, type, row)
                {
                  if (data == "0") {
                    return '<span class="badge bg-danger"><i class="far fa-bell"></i> INHABILITADO</span>';
                  }
                    return '<span class="badge bg-success"><i class="far fa-bell"></i> HABILITADO</span>';
                }
              },
              { data: 'btn_actions'}
          ],
          columnDefs: [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },
            { width: "90px", targets: 9 }
          ]
        });
      }); 
    </script>
@endpush



