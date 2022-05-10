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
              @can('deudapersona.create')
              <a href="{{ route('deudaarquitectos.create') }}" class="btn btn-outline-success btn-lg" title="Crear nueva deuda."><i class="fas fa-plus"></i></a>
              @endcan
              
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
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
                <th></th>
                <th></th>
                <th></th>
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
<!-- Add Modal start -->
<div class="modal fade modal-slide-in-right" id="modal-addpayment">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Pago</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hiden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Monto:</label>
                  <input type="number" class="form-control" id="monto">
                </div>
              </div>
            </div>
            <button id="store_action" type="button" class="tn btn-outline-info">Guarda</button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- End Modal content-->
    </div>
  </div>
  <!-- add code ends -->
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
      var stId = null;
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
          ajax: '{!! route('getdeuda') !!}',
          columns: [
              { data: 'id', name: 'id' },
              { data: 'persona.nombre', name: 'persona.nombre' },
              { data: 'persona.apaterno', name: 'persona.apaterno' },
              { data: 'persona.amaterno', name: 'persona.amaterno' },
              { data: 'gestion', name: 'gestion' },
              { data: 'tipopago.nombrepago', name: 'tipopago.nombrepago' },
              { data: 'detalledeudas', name: 'detalledeudas' },
              { data: 'cuotas', name: 'cuotas' },
              { data: 'cuotasrestantes',
                render: function (data, type, row)
                {
                  if (row.montodeuda == (parseFloat(row.detalledeudas) + parseFloat(row.desc_total))) {
                    return 0;
                  }
                    return row.cuotasrestantes;
                }
              },
              { data: 'montorestante',
              render: function (data, type, row)
                {
                  if (row.montodeuda == (parseFloat(row.detalledeudas) + parseFloat(row.desc_total))) {
                    return '<span class="badge bg-success"><i class="far fa-bell"></i> CANCELADO</span>';
                  }
                    return '<span class="badge bg-danger"><i class="far fa-bell"></i> ADEUDO</span>';
                }
              },
              { data: 'btn_edit', name: 'btn_edit'},
              { data: 'btn_add_payment', name: 'btn_add_payment'},
              { data: 'btn_pdfdetalledeuda', name: 'btn_pdfdetalledeuda'}
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

        //augusto
        
        function getPagoId() {
           $('#modal-addpayment').on('show.bs.modal', function (event) {
               var button = $(event.relatedTarget) // Button that triggered the modal
               var id = button.data('pagoid'); // Extract info from data-* attributes
               stId = id;
           });

       }
       getPagoId();
      }); 
      $('#modal-addpayment').on('click', '#store_action', function(e) {
          e.preventDefault();
          var token = $("meta[name='csrf-token']").attr("content");
          
          var monto = $("#monto").val();
          $.ajax({
              type: 'POST',
              url: "{{route('add.payment', '')}}"+"/"+stId,
              data: {
                  'id': stId,
                  'monto': monto,
                  "_token": token,
              },
              success: function (data) {
                if (data.deuda) {
                  $("#modal-addpayment").modal('hide');
                  alert(data.message);
                  $('#deudasTable').DataTable().ajax.reload();
                }else{
                  alert(data.message);
                }
                
                  // $('.item' + $('.id').text()).remove();
              }
          });
    });
    </script>
@endpush


