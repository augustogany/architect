@extends('layouts.app')
@section('title','Proyectos Urbanización')

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
                  Proyectos: Urbanizaciones / Lista de Proyectos
                    <div class="card-tools">
                      <a href="{{ route('proyectourbanizacion.create') }}" class="btn btn-outline-success btn-lg" title="Crear Nuevo Proyecto"><i class="fas fa-plus"></i></a>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                  <table id="proyectourbanizacionTable" class="table table-striped"  style="font-size: 9pt">
                    <thead>
                      <tr>
                        <th></th>
                        <th style="background-color: #F6F5A9">Nombre proyecto</th style="background-color: #F6F5A9">
                        <th style="background-color: #F6F5A9">DE:</th>
                        <th style="background-color: #F6F5A9">A:</th>
                        <th style="background-color: #F6F5A9">Visado $U.S.</th>
                        <th style="background-color: #F6F5A9">Visado Bs.</th>
                        <th style="background-color: #C2E4DD">Nonbres</th>
                        <th style="background-color: #C2E4DD">Apellido paterno</th>
                        <th style="background-color: #C2E4DD">Apellido materno</th>
                        <th style="background-color: #C2E4DD">Código Arquitecto</th>
                        <th>Fecha registro</th>
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
        $('#proyectourbanizacionTable').DataTable({
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
          ajax: '{!! route('getProyectourbanizacion') !!}',
          columns: [
              { data: 'id', name: 'id' },
              { data: 'proyecto', name: 'proyecto' },
              { data: 'categoriaurbanizacion.mt2_inicio', name: 'categoriaurbanizacion.mt2_inicio' },
              { data: 'categoriaurbanizacion.mt2_fin', name: 'categoriaurbanizacion.mt2_fin' },
              { data: 'visado_sus_categoria', name: 'visado_sus_categoria' },
              { data: 'visado_bs_categoria', name: 'visado_bs_categoria' },
              { data: 'persona.nombre', name: 'persona.nombre' },
              { data: 'persona.apaterno', name: 'persona.apaterno' },
              { data: 'persona.amaterno', name: 'persona.amaterno' },
              { data: 'persona.numeroregistro', name: 'persona.numeroregistro' },
              { data: 'fecharegistro', name: 'fecharegistro' },
              { data: 'btn_actions'}
          ],
          "columnDefs": [
            {
              "targets": [ 0 ],
              "visible": false,
              "searchable": false
            },
            { width: "115px", targets: 11 }
          ],
          rowCallback:function(row,data) {
            if(data[0] != "")
            {
              $($(row).find("td")[0]).css("background-color","#F9D3D0");
            }
            if(data[9] != "")
            {
              $($(row).find("td")[9]).css("background-color","#F9D3D0");
            }
          }
        });
    </script>
@endpush
