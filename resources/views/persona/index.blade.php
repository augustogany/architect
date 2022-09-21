@extends('layouts.app')
@section('title','Arquitectos del CADBENI')

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
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-th-list"></i>
          Lista de Arquitectos del CADBENI
          <div class="card-tools">
            <a href="{{ route('personas.create') }}" class="btn btn-outline-success" title="Crear nueva persona"><span>Agregar <i class="fas fa-plus"></i></span></a>
            {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button> --}}
          </div>
        </div>

        <div class="card-body">
          <table id="personasTable" class="table table-striped"  style="font-size: 9pt">
            {{-- <thead>
              <tr>
                <th>Nombre</th>
                <th>A. Paterno</th>
                <th>A. Materno</th>
                <th>Nro. Registro</th>
                <th>Tel. Domicilio</th>
                <th>Tel. Oficina</th>
                <th>Tel. Celular</th>
                <th>Dirección</th>
                <th>E-Mail</th>
                <th>Fecha de afiliación</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead> --}}
          </table>
        </div>
        <div class="card-footer">
          <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.2
          </div>
          <strong>Copyright &copy; 2022 <a href="#">C@DBENI</a>.</strong> odos los derechos reservados
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push ('styles')
    <link href="{{ asset('theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">

    <style>
      .btn-sm{
        margin: 2px 0px !important;
      }
    </style>
@endpush

@push ('script')
    <script src="{{asset('theme/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

    <script>
        $('#personasTable').DataTable({
          // "responsive": true,
          "autoWidth": true,
          // "scrollY":        "280px",
          "scrollCollapse": true,
          //"pagingType": "full_numbers",
          processing: true,
          serverSide: true,
          language: {
                 "url": '{!! asset('theme/plugins/datatables/espanol.json') !!}'
                  } ,
          ajax: '{!! route('getPersona') !!}',
          // order: [[1, 'asc']],
          columns: [
              
              { data: 'apaterno', title: 'A. paterno' },
              { data: 'amaterno', title: 'A. materno' },
              { data: 'nombre', title: 'Nombre(s)' },
              { data: 'numeroregistro', title: 'Nro. Registro' },
              { data: 'telefono', title: 'Telefono', css: 'text-align: right' },
              { data: 'direccion', title: 'Dirección' },
              { data: 'correo', title: 'Email' },
              { data: 'fecha_afiliacion', title: 'Fecha de afiliación' },
              { data: 'ultimo_pago', title: 'Último pago' },
              { data: 'deuda', title: 'Deuda'},
              { data: "condicion", title : 'Estado', 
              render: function (data, type, row)
                {
                  if (data == "1") {
                    return '<span class="badge bg-info"><i class="far fa-bell"></i> ACTIVO</span>';
                  }
                    return '<span class="badge bg-danger"><i class="far fa-bell"></i> INACTIVO</span>';
                }
              },
              { data: 'btn_actions'}
          ],
          columnDefs: [
            {
                targets: 2,
                className: 'text-left'
            }
          ]
        });
    </script>
@endpush


