@extends('layouts.app')
@section('title','Kardex Personal')

@section('content')

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-10">
      {{-- <form id="FileForm" enctype="multipart/form-data" >
       @csrf
        <div class="card">
          <div class="card-header">
            <i class="fas fa-th-list"></i>
              DOCUMENTACION
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              </div>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                      <div class="form-group">
                          <div class="form-line">
                            <?php
                            $archivo = '';
                            if ($persona->documentation()->exists()) {
                              $archivo = $persona->documentation->archivo ? \Storage::url($documentacion->curriculo) : '';
                            }
                             
                            ?>                        
                                <div style="padding-bottom: 2%">
                                  <input type="file" name="urlpdf">
                                  <input type="hidden" name="id" value="{{$documentacion->id ?? null}}">
                                  <input type="hidden" name="persona_id" value="{{$persona->id ?? null}}">
                                    <a 
                                      id="pdfImage"
                                      href="{{ $archivo }}" 
                                      target="_blank">
                                      <img src="/theme/dist/img/pdf.png"  target="_blank" width="50">
                                    </a>
                                </div>
                          </div>
                          <small>Curriculum Vitae *</small>
                      </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                      <div class="form-line">
                          <input 
                              type="text" 
                              class="form-control form-control-sm" 
                              required 
                              name="serv_militar" 
                              placeholder="Servicio militar.." 
                              onkeyup ="this.value=this.value.toUpperCase()"
                              value="{{$documentacion->serv_militar ?? ''}}"
                          >
                      </div>
                      <small>Servicio Militar *</small>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                      <div class="form-line">
                          <input 
                              type="text" 
                              class="form-control form-control-sm" 
                              required 
                              name="nit" 
                              placeholder="nit.." 
                              value="{{$documentacion->nit ?? ''}}"
                          >
                      </div>
                      <small>NIT</small>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <input type="submit" class="btn btn-outline-info" id="cancelar" value="Enviar">
                  </div>
                </div>
            </div>
          </div>
        </div>
      </form> --}}
      
      <div class="card">
        <div class="card-header">
          <i class="fas fa-th-list"></i>
            Experiencia Laboral
            <div class="card-tools">
              {{-- <button type="button" data-toggle="modal" data-target="#addModal" class="btn btn-outline-success btn-lg" title="Crear nuevo"><i class="fas fa-plus"></i></button> --}}
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
          {{-- <table id="experienciasTable" class="table table-striped"  style="font-size: 9pt">
            <thead>
              <tr>
                <th></th>
                <th>Empresa</th>
                <th>Cargo</th>
                <th>Desde</th>
                <th>Hasta</th>
                <th>Options</th>
              </tr>
            </thead>
          </table> --}}
          <textarea id="mytextarea">Hello, World!</textarea>
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
  
  <!-- Add Modal start -->
  {{-- <div class="modal fade modal-slide-in-right" id="addModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Añadir Experiencia</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hiden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ url('guardarexperiencia') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="persona_id" value="{{$persona->id ?? null}}">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="name">Empresa:</label>
                  <input type="text" class="form-control" id="empresa" name="empresa">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="last_name">Cargo:</label>
                  <input type="text" class="form-control" id="cargo" name="cargo">
                </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="last_name">Desde:</label>
                    <input type="date" class="form-control" id="desde" name="desde">
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="last_name">Hasta:</label>
                  <input type="date" class="form-control" id="hasta" name="hasta">
                </div>
              </div>
            </div>
            <button type="submit" class="tn btn-outline-info">Guarda</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> --}}

  <!-- Add Modal start -->
  {{-- <div class="modal fade modal-slide-in-right" id="modal_edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar Experiencia</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hiden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Empresa:</label>
                  <input type="text" class="form-control" id="empresae">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="last_name">Cargo:</label>
                  <input type="text" class="form-control" id="cargoe">
                </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="last_name">Desde:</label>
                    <input type="date" class="form-control" id="desdee">
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="last_name">Hasta:</label>
                  <input type="date" class="form-control" id="hastae">
                </div>
              </div>
            </div>
            <button id="edit_action" type="button" class="tn btn-outline-info">Guarda</button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> --}}
  
  
  {{-- <div class="modal modal-danger fade" id="modal_delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Eliminar Experiencia</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hiden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>Esta usted Seguro de Eliminar?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dange pull-left" data-dismiss="modal">Cancel</button>
                <button id="delete_action" type="button" class="btn btn-outline-info">Confirmar</button>
            </div>
        </div>
    </div>
  </div> --}}
  {{-- <input type="hidden" id="item_id" value="0" /> --}}
</div>

@endsection

@push ('styles')
    {{-- <link href="{{ asset('theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"> --}}

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"> --}}
    <style>
      table th {
        text-align: center;
      }
  
      table td {
        text-align: center;
      }
      .barra{
        background-color: #f3f3f3;
        border-radius: 5px;
        box-shadow: inset 0px 0px 5px rgba(0,0,0,.2);
        height: 15px;
        margin-bottom: 2%;
      }
      .barra_azul{
        background-color: #247CC0;
        border-radius: 5px;
        display: block;
        height: 15px;
        line-height: 15px;
        text-align: center;
        width: 0%;
      }
      .barra_verde{
        background-color: #2EA265 !important
      }
      .barra_roja{
        background-color: #DE3152 !important
      }
      #barra_estado span{
        color: #fff;
        font-weight: bold;
        line-height: 15px;
      }
    </style>
@endpush

@push ('script')
    {{-- <script src="{{asset('theme/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script> --}}

    {{-- <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script> --}}


    {{-- <script>
      var YajraDataTable;
      function delete_action(item_id){
          $('#item_id').val(item_id);
      }
      function edit_action(this_el, item_id){
          $('#item_id').val(item_id);
          var tr_el = this_el.closest('tr');
          var row = YajraDataTable.row(tr_el);
          var row_data = row.data();
          $('#empresae').val(row_data.empresa);
          $('#cargoe').val(row_data.cargo);
          $('#desdee').val(row_data.desde);
          $('#hastae').val(row_data.hasta);
      }
      function initDataTable() {
        YajraDataTable = $('#experienciasTable').DataTable({
            "responsive": true,
            // "scrollY":   "300px",
            "processing": true,
            "serverSide": true,
            "scrollCollapse": true,
            "language": {
                 "url": "{!! asset('theme/plugins/datatables/espanol.json') !!}"
                  },
            "ajax": "{!! route('experiencias') !!}",
            "columns":[
              { "data": "id", "name": "id" },
              { "data": "empresa", "name": "empresa" },
              { "data": "cargo", "name": "cargo" },
              { "data": "desde", "name": "desde" },
              { "data": "hasta", "name": "hasta" },
              { "data": ""     , "name":  ""     }
            ],
            "autoWidth": false,
            'columnDefs': [
                {
                    'targets': -1,
                    'defaultContent': '-',
                    'searchable': false,
                    'orderable': false,
                    'width': '15%',
                    'className': 'dt-body-center',
                    'render': function (data, type, full_row, meta){
                        return '<div style="display:block">' +
                            '<button onclick="delete_action(' + full_row.id + ')" type="button" class="delete_action btn btn-outline-danger btn-md" data-toggle="modal" data-target="#modal_delete" style="margin:3px"><i class="fa fa-trash"></i></button>' +
                            '<button onclick="edit_action(this, ' + full_row.id + ')" type="button" class="edit_action btn btn-outline-info btn-md" data-toggle="modal" data-target="#modal_edit" style="margin:3px"><i class="fa fa-edit"></i></button>' +
                            '</div>';
                    }

                }
            ],
        });
        return YajraDataTable;
      }
      $(document).ready(function() {
        //$.noConflict();

        YajraDataTable = initDataTable();
       

        let form = document.getElementById('FileForm');
        form.addEventListener("submit", function(event){
          event.preventDefault();
          subir_archivo(this);
        });

        $('#delete_action').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('experiencia.delete') }}",
                data: {
                    'item_id': $('#item_id').val(),
                    '_token': "{{ csrf_token() }}"
                },
                type: "POST",
                success: function (data) {
                    $('#modal_delete').modal('hide');
                    YajraDataTable.ajax.reload(null, false);
                    console.log(data.message);
                }
            })
        });

        $('#edit_action').on('click', function (e) {
            e.preventDefault();
            $("#modal_edit").modal("hide");
            $.ajax({
                url: "{{ route('experiencias.update') }}",
                data: {
                    'item_id': $('#item_id').val(),
                    'empresa': $('#empresae').val(),
                    'cargo': $('#cargoe').val(),
                    'desde': $('#desdee').val(),
                    'hasta': $('#hastae').val(),
                    '_token': "{{ csrf_token() }}"
                },
                type: "POST",
                success: (response) => {
                    $("#modal_edit").modal("hide");
                    YajraDataTable.ajax.reload(null, false);
                    console.log(response.message);
                }
            })
        });
        $('#modal_edit').on('hidden.bs.modal', function () {
            $('#item_id').val(0);
            $('#empresae').val("");
            $('#cargoe').val("");
            $('#desdee').val("");
            $('#hastae').val("");
        });
        $('#modal_delete').on('hidden.bs.modal', function () {
            $('#item_id').val(0);
        });
      }); 
      
      function subir_archivo(form){
        var $pdfImage = $('#pdfImage');
        //let barra_estado = form.children[1].children[0],
        // span = barra_estado.children[0],
        // boton_cancelar = form.children[2].children[1];

        // barra_estado.classList.remove('barra_verde','barra_verde');

        // //peticion
        // let peticion = new XMLHttpRequest();
        // //progreso
        // peticion.upload.addEventListener("progress",(event)=>{
        //   let porcentaje = Math.round((event.loaded / event.total) * 100);
        //   console.log(porcentaje);
        //   barra_estado.style.width = porcentaje+'%';
        //   span.innerHTML = porcentaje+'%';
        // });

        // //finalizado
        // peticion.addEventListener("load", () => {
        //   barra_estado.classList.add('barra_verde');
        //   span.innerHTML = "Proceso Completado";
        // });

        //enviar datos
        $.ajax({
            url: '/guardar',
            type: 'post',
            cache: false,
            data: new FormData(form),
            processData: false, // Recuerde agregar estos dos, de lo contrario puede haber errores
            contentType: false,    //
            success: function(result)
            {
              console.log(result);
              if (result.documento) {
                $pdfImage.attr('href', 'storage/'+result.documento.curriculo);
              }
               alert(result.message);
            },
            fail: function(){
            }
        });
        //cancelar
        // boton_cancelar.addEventListener("click", () => {
        //   peticion.abort();
        //   barra_estado.classList.remove('barra_verde');
        //   barra_estado.classList.add('barra_roja');
        //   span.innerHTML = "Proceso Cancelado";
        // });
      }
    
    </script> --}}

  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
    tinymce.init({
        selector: '#mytextarea',
        language: "es"
      });
	</script>
@endpush



