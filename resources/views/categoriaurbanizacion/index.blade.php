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
      Categoría Urbanización - Aranceles
      <div class="card-tools">
        <a href="" data-toggle="modal" data-target="#modal-calcular_precios" class="btn btn-outline-success" title="Calcular Monto de Mts2"><i class="fas fa-calculator"></i></a>
        <a href="{{route('print_categoria_urbanizacion')}}" class="btn btn-outline-success" title="Imprimir Categoría Urbanización" target="_blank"><i class="fas fa-file-pdf"></i></a>
      </div>
      </div>

        <div class="card-body">
          <table id="dataTable" class="table table-striped" style="font-size: 10pt">
            <thead>
              <tr>
                <th>De</th>
                <th>A</th>
                <th>Costo</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($categorias as $item)
                <tr>
                  <td>{{ $item->mt2_inicio }}</td>
                  <td>{{ $item->mt2_fin }}</td>
                  <td>{{ number_format($item->costo_pu, 2 , ',', '.') }}</td>
                  <td>
                    @can('categoria_urbanizacion.edit')
                    <a href="{{ route('categoriaurbanizacion.edit', $item->id) }}" title="Editar" class="btn btn-success"><i class="fas fa-edit"></i></a>
                    @endcan
                  </td>
                </tr>
              @endforeach
            </tbody>
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

<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-calcular_precios">
  <form action="" method="POST">
    @csrf
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Calcular costo de Superficie</h4>
            </div>
            <div class="modal-body">
              <!-- === -->
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" class="form-control form-control-sm" required id="mts2" min="0" placeholder=" Ingresar Mt2." autocomplete="off">
                    </div>
                    <small>Superficie Mt2.</small>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                      <div class="form-line">
                          <input type="text" readonly id="costo" class="form-control form-control-sm" required placeholder="Precio Categoría" autocomplete="off">
                      </div>
                      <small>Precio Categoría.</small>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" class="form-control form-control-sm" readonly id="totalbs" placeholder="Costo Bs.">
                    </div>
                    <small>Costo Superficie Mt2.</small>
                  </div>
                </div>
              </div>
              <!-- === -->
                
              <!-- === -->
            </div>
          <div class="modal-footer text-right">
            <button type="button" class="btn btn-outline-success" data-dismiss="modal">cerrar</button>
          </div>
        </div>
    </div>
    </form>
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
      var categorias = @json($categorias);

      $(document).ready(function(){
        $('#dataTable').DataTable({"order":[],"language":{"sEmptyTable":"No hay datos disponibles en la tabla","sInfo":"Mostrando _START_ a _END_ de _TOTAL_ entradas","sInfoEmpty":"Mostrando 0 a 0 de 0 entradas","sInfoFiltered":"(Filtrada de _MAX_ entradas totales)","sInfoPostFix":"","sInfoThousands":",","sLengthMenu":"Mostrar _MENU_ entradas","sLoadingRecords":"Cargando...","sProcessing":"Procesando...","sSearch":"Buscar:","sZeroRecords":"No se encontraron registros coincidentes","oPaginate":{"sFirst":"Primero","sLast":"\u00daltimo","sNext":"Siguiente","sPrevious":"Anterior"},"oAria":{"sSortAscending":": Activar para ordenar la columna ascendente","sSortDescending":": Activar para ordenar la columna descendente"}},"columnDefs":[{"targets":"dt-not-orderable","searchable":false,"orderable":false}]});

        $('#mts2').keyup(function(){
          let cantidad = $('#mts2').val() ? parseInt($('#mts2').val()) : 0;
          let categoria = null;
          categorias.map(item => {
            let inicio = item.mt2_inicio;
            let fin = item.mt2_fin;
            if(inicio && !isNaN(fin)){
              if(cantidad >= parseInt(inicio) && cantidad <= parseInt(fin)){
                categoria = item;
              }
            }
            else{
              if(cantidad >= parseFloat(inicio)){
                categoria = item;
              }
            }
          });

          if(categoria){
            $('#costo').val(new Intl.NumberFormat().format(parseFloat(categoria.costo_pu).toFixed(2)));
            $('#totalbs').val(new Intl.NumberFormat().format(parseFloat(cantidad * categoria.costo_pu).toFixed(2)));
          }else{
            $('#costo').val('');
            $('#totalbs').val('');
          }
        });
      });
    </script>
@endpush
