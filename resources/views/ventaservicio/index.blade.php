@extends('layouts.app')
@section('title','Lista de Ventas de Servicios')

<style>
    table th {
      text-align: center;
      /*background-color: #C0C6C1;*/
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
          Lista de Ventas de Servicios
            <div class="card-tools">
              @can('ventaservicio.create')
              <a href="{{ route('ventaservicio.create') }}" class="btn btn-outline-success btn-lg" title="Crear nueva venta de servicio."><i class="fas fa-plus"></i></a>
              @endcan

              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
          <table id="ventaservicioTable" class="table table-striped"  style="font-size: 9pt">
            <thead>
              <tr>
                <th></th>
                <th style="background-color: #C2E4DD">Nonbres</th>
                <th style="background-color: #C2E4DD">Apellido paterno</th>
                <th style="background-color: #C2E4DD">Apellido materno</th>
                <th>Gestión Venta</th>
                <th>Importe Venta</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
          </table>
        </div>
        <div class="card-footer">
          <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.2
          </div>
          <strong>Copyright &copy; 2022 <a href="#">CADBENI</a>.</strong> Todos los derechos reservados.
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Modal -->

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
      $(document).ready(function() {
        //$.noConflict();
        $('#ventaservicioTable').DataTable({
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
          ajax: '{!! route('getventaservicio') !!}',
          columns: [
              { data: 'id', name: 'id' },
              { data: 'persona.nombre', name: 'persona.nombre' },
              { data: 'persona.apaterno', name: 'persona.apaterno' },
              { data: 'persona.amaterno', name: 'persona.amaterno' },
              { data: 'gestion', name: 'gestion' },
              { data: 'totalbs', name: 'totalbs' },
              { data: 'estado',
              render: function (data, type, row)
                {
                  if (data != "ACTIVO") {
                    return '<span class="badge bg-danger"><i class="far fa-bell"></i> DESHABILITADO</span>';
                  }
                    return '<span class="badge bg-success"><i class="far fa-bell"></i> ACTIVO</span>';
                }
              },
              { data: 'btn_actions'}
          ],
          columnDefs: [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
          ],
          rowCallback:function(row,data) {
            if(data[4] != "")
            {
              $($(row).find("td")[4]).css("background-color","#F9D3D0");
            }
          }
        });
      });

    </script>
@endpush


