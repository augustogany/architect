@extends('layouts.app')
@section('title','Proyectos Generales')

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
          Proyectos: Viviendas - Comercio y Oficinas / Lista de Proyectos
            <div class="card-tools">
              <a href="{{ route('proyectogeneral.create') }}" class="btn btn-outline-success btn-lg" title="Crear nuevo proyecto."><i class="fas fa-plus"></i></a>
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
          <table id="proyectogeneralTable" class="table table-striped"  style="font-size: 9pt">
            <thead>
              <tr>
                <th></th>
                <th style="background-color: #F6F5A9">Nombre proyecto</th>
                <th style="background-color: #F6F5A9">Categoría proyecto</th>
                <th style="background-color: #F6F5A9">Superficie Mt2</th>
                <th style="background-color: #C2E4DD">Nonbres</th>
                <th style="background-color: #C2E4DD">Apellido paterno</th>
                <th style="background-color: #C2E4DD">Apellido materno</th>
                <th style="background-color: #C2E4DD">Cod. Arquitecto</th>
                <th style="background-color: #C2E4DD">Estado</th>
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
        $('#proyectogeneralTable').DataTable({
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
          ajax: '{!! route('getProyectogeneral') !!}',
          columns: [
              { data: 'id', name: 'id' },
              { data: 'proyecto', name: 'proyecto' },
              { data: 'categoriageneral.nombre', name: 'categoriageneral.nombre' },
              { data: 'superficiemts2', name: 'superficiemts2' },
              { data: 'persona.nombre', name: 'persona.nombre' },
              { data: 'persona.apaterno', name: 'persona.apaterno' },
              { data: 'persona.amaterno', name: 'persona.amaterno' },
              { data: 'persona.numeroregistro', name: 'persona.numeroregistro' },
              { data: 'estado', name: 'estado' },
              { data: 'fecharegistro', name: 'fecharegistro' },
              { data: 'btn_actions'}
          ],
          "columnDefs": [
            {
              "targets": [ 0 ],
              "visible": false,
              "searchable": false
            },
            { width: "70px", targets: 8 },
            { width: "115px", targets: 9 }
          ],
          rowCallback:function(row,data) {
            if(data[0] != "")
            {
              $($(row).find("td")[0]).css("background-color","#F9D3D0");
            }
            if(data[7] != "")
            {
              $($(row).find("td")[7]).css("background-color","#F9D3D0");
            }
          }
          // dom: 'Bfrtip',
          // buttons: [
          //   'excelHtml5',
          //   'csvHtml5'
          // ] 
        });
      }); 
    </script>



@endpush


