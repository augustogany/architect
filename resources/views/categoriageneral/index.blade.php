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
    <div class="col-md-6">
      <div class="card">
      <div class="card-header">
      <i class="fas fa-list"></i>
      Categoría General - Aranceles.
        <div class="card-tools">
          <a href="" data-toggle="modal" data-target="#modal-calcular_precios" class="btn btn-outline-success" title="Calcular Monto de Mts2"><i class="fas fa-calculator"></i></a>

          <a href="{{route('print_categoria_general')}}" class="btn btn-outline-success" title="Imprimir Categoría General" target="_blank"><i class="fas fa-file-pdf"></i></a>

        </div>
      </div>

        <div class="table-responsive">
          <table class="table table-striped" style="font-size: 10pt">
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
                  @can('categoria_general.edit')
                  <a href="{{route('categoriageneral.edit',$categoriageneral->id)}}" title="Editar categoría general" class="btn btn-success"><i class="fas fa-edit"></i></a>
                  @endcan
                </td>
              </tr>
            @empty
            <p style="text-align: center;">No hay registros para mostrar.</p>
            @endforelse
            </tbody>
          </table>
        </div>

        <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
        {{ $categoriagenerals->links() }}
        </ul>
        @if(count($categoriagenerals) > 0)
        <p>Mostrando {{ $categoriagenerals->firstItem() }} al {{ $categoriagenerals->lastItem() }} de {{ $categoriagenerals->total() }} Registros</p>
        @endif
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
              <button type="button" id="refrescar" class="btn btn-outline-success" data-dismiss="modal">cerrar</button>
            </div>
            <div class="modal-body">
              <!-- === -->
              <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="form-line">
                          <select required id="categoriageneral_id" class="form-control form-control-sm select2">
                            <option selected disabled value="">Seleccionar Categoría</option>
                            @foreach ($categoriagenerals as $categoriageneral)
                              <option value="{{$categoriageneral->id}}_{{$categoriageneral->costo}}">{{$categoriageneral->nombre}}</option>
                            @endforeach
                          </select>
                        </div>
                        <small>Categorias.</small>
                    </div>
                </div>
                <!-- === -->
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
                      <input type="number" class="form-control form-control-sm" required id="mts2" placeholder=" Ingresar Mt2." autocomplete="off">
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
          <div class="modal-footer justify-content-between">
            
            <button type="button" class="btn btn-outline-success" onclick="limpiar();">limpiar</button>
            <button type="button" class="btn btn-outline-success" onclick="calcular_mts2();">calcular costo</button>
          </div>
        </div>
    </div>
    </form>
</div>
<!-- == Cerrar Modal== -->
@endsection

@push ('script')
  <script>
    //Select filtro + Categoria General let detalle_subtotal = parseFloat(calcular_total()+subtotal).toFixed(2);
    $("#categoriageneral_id").change(mostrarValoresCategoriageneral);
    function mostrarValoresCategoriageneral()
    {
        datoCategoria = document.getElementById('categoriageneral_id').value.split('_');
        $("#categoriageneral_id_input").val(datoCategoria[0]);
        $("#costo").val(datoCategoria[1]);
    }

    function calcular_mts2()
    {
      var var_costo = parseFloat(document.getElementById('costo').value).toFixed(2);
      var var_mts2 = parseFloat(document.getElementById('mts2').value).toFixed(2);
      var resultado = 0

      resultado = (var_costo * var_mts2).toFixed(2);
      $("#totalbs").val(resultado);
    }

    function limpiar()
    {
      document.getElementById("mts2").value = "";
      document.getElementById("totalbs").value = "";
    }

    $(document).ready(function(){
    //Creamos el evento click del botón
      $("#refrescar").click(function(){
      //Actualizamos la página
      location.reload();
      });
    });
  </script>
@endpush