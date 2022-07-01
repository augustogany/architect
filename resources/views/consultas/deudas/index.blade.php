@extends('layouts.app')
@section('title','Lista de Deudas Arquitectos')

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
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-th-list"></i>
          Lista de Deudas de Arquitectos del CADBENI
            <div class="card-tools">
              
            </div>
        </div>
        <div class="card-body">
          <table id="deudasTable" class="table table-striped"  style="font-size: 9pt">
            <thead>
              <tr>
                <th></th>
                <th style="background-color: #C2E4DD">Nonbres</th>
                <th style="background-color: #C2E4DD">Apellido paterno</th>
                <th style="background-color: #C2E4DD">Apellido materno</th>
                <th>Gestión deuda</th>
                <th>Tipo pago</th>
                <th>Monto pagado</th>
                <th>Total cuotas</th>
                <th>cuotas restantes</th>
                <th>Estado</th>
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
        $('#deudasTable').DataTable({
          "responsive": true, "autoWidth": true,
          "order": [[ 0, "desc" ]],
          "scrollY":        "280px",
          "scrollCollapse": true,
          //"pagingType": "full_numbers",
          processing: true,
          serverSide: true,
          language: {
                 "url": '{!! asset('theme/plugins/datatables/espanol.json') !!}'
                  } ,
          ajax: '{!! route('consulta_deudas') !!}',
          columns: [
              { data: 'id', name: 'id' },
              { data: 'persona.nombre', name: 'persona.nombre' },
              { data: 'persona.apaterno', name: 'persona.apaterno' },
              { data: 'persona.amaterno', name: 'persona.amaterno' },
              { data: 'gestion', name: 'gestion' },
              { data: 'tipopago.nombrepago', name: 'tipopago.nombrepago' },
              { data: 'montopagado', name: 'montopagado' },
              { data: 'cuotas', name: 'cuotas' },
              { data: 'cuotasrestantes', name: 'cuotasrestantes' },
              { data: 'montorestante',
              render: function (data, type, row)
                {
                  if (data == "0.00") {
                    return '<span class="badge bg-success"><i class="far fa-bell"></i> CANCELADO</span>';
                  }
                    return '<span class="badge bg-danger"><i class="far fa-bell"></i> ADEUDO</span>';
                }
              }
          ],
          "columnDefs": [
            {
              "targets": [ 0 ],
              "visible": false,
              "searchable": false
            }
          ],
          rowCallback:function(row,data) {
            if(data[5] != "")
            {
              $($(row).find("td")[5]).css("background-color","#F9D3D0");
            }
            if(data[7] != "")
            {
              $($(row).find("td")[7]).css("background-color","#F9D3D0");
            }
          }
        });
      }); 
    </script>
@endpush


