@extends('layouts.app')
@section('title','Categoría General')

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
          Categoría General - Aranceles
          <div class="card-tools">
            <a href="{{route('print_categoria_general')}}" class="btn btn-outline-success" title="Imprimir Categoría General" target="_blank"><i class="fas fa-file-pdf"></i></a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table table-striped" style="font-size: 10pt">
              <thead>
                <tr>
                  <th>Categoría</th>
                  <th>Costo</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @forelse($categoriagenerals as $categoriageneral)
                  <tr>
                    <td>{{$categoriageneral->nombre}}</td>
                    <td>{{$categoriageneral->costo}}</td>
                    <td>
                      <a data-toggle="modal" data-target="#modal-calcular_precios" data-item='@json($categoriageneral)' class="btn btn-success btn-sm btn-calculate" title="Calcular Monto de Mts2"><i class="fas fa-calculator text-white"></i></a>
                      @can('categoria_general.edit')
                      <a href="{{route('categoriageneral.edit',$categoriageneral->id)}}" class="btn btn-primary btn-sm" title="Editar categoría general"><i class="fas fa-edit"></i></a>
                      @endcan
                    </td>
                  </tr>
                @empty
                {{-- <p style="text-align: center;">No hay registros para mostrar.</p> --}}
                @endforelse

                {{-- <ul class="pagination pagination-sm m-0 float-right">
                  {{ $categoriagenerals->links() }}
                </ul>
                @if(count($categoriagenerals) > 0)
                <p>Mostrando {{ $categoriagenerals->firstItem() }} al {{ $categoriagenerals->lastItem() }} de {{ $categoriagenerals->total() }} Registros</p>
                @endif --}}
              </tbody>
            </table>
          </div>
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

<!-- ==Modal== -->
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
                            <input type="text" readonly id="costo" class="form-control form-control-sm" required placeholder="Precio Categoría" autocomplete="off">
                        </div>
                        <small>Precio Categoría.</small>
                    </div>
                </div>
                <!-- === -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" class="form-control form-control-sm" required id="mts2" min="0" placeholder=" Ingresar Mt2." autocomplete="off">
                    </div>
                    <small>Superficie Mt2.</small>
                  </div>
                </div>
                <!-- === -->
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
<!-- == Cerrar Modal== -->
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
    var categoriageneral;

    $(document).ready(function(){

      $('#dataTable').DataTable({"order":[],"language":{"sEmptyTable":"No hay datos disponibles en la tabla","sInfo":"Mostrando _START_ a _END_ de _TOTAL_ entradas","sInfoEmpty":"Mostrando 0 a 0 de 0 entradas","sInfoFiltered":"(Filtrada de _MAX_ entradas totales)","sInfoPostFix":"","sInfoThousands":",","sLengthMenu":"Mostrar _MENU_ entradas","sLoadingRecords":"Cargando...","sProcessing":"Procesando...","sSearch":"Buscar:","sZeroRecords":"No se encontraron registros coincidentes","oPaginate":{"sFirst":"Primero","sLast":"\u00daltimo","sNext":"Siguiente","sPrevious":"Anterior"},"oAria":{"sSortAscending":": Activar para ordenar la columna ascendente","sSortDescending":": Activar para ordenar la columna descendente"}},"columnDefs":[{"targets":"dt-not-orderable","searchable":false,"orderable":false}]});


      $('.btn-calculate').click(function(){
        categoriageneral = $(this).data('item');
        $("#costo").val(categoriageneral.costo);
      });

      $('#mts2').keyup((e) => {
        let value = $('#mts2').val();
        resultado = (categoriageneral.costo * value).toFixed(2);
        $("#totalbs").val(resultado);
      });

      $('#mts2').change((e) => {
        let value = $('#mts2').val();
        resultado = (categoriageneral.costo * value).toFixed(2);
        $("#totalbs").val(resultado);
      });

    });
  </script>
@endpush