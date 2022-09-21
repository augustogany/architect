@extends('layouts.app')
@section('title','Pago de mensualidad')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-th-list"></i> Lista de proyectos de urbanización
                        <div class="card-tools">
                            <a href="{{ route('personas.index') }}" class="btn btn-outline-dark" title="Volver a la lista">Volver <i class="fas fa-list"></i></a>
                            <a href="#" data-toggle="modal" data-target="#modal-agregar" class="btn btn-outline-success" title="Agregar nuevo pago">Agregar <i class="fas fa-plus"></i></a>
                            {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>N&deg; de recibo</th>
                                        <th>Sucursal</th>
                                        <th>Fecha de registro</th>
                                        <th>Precio unit.</th>
                                        <th>Total</th>
                                        <th>Observaciones</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($proyectos as $item)
                                        <tr>
                                            <td>{{ str_pad($item->id, 5, "0", STR_PAD_LEFT) }}</td>
                                            <td>{{ $item->sucursal->sucursal }}</td>
                                            <td>{{ date('d/M/Y', strtotime($item->fecharegistro)) }}</td>
                                            <td>{{ number_format($item->costo_pu_categoria, 2, ',', '.') }}</td>
                                            <td>{{ number_format($item->totalbs, 2, ',', '.') }}</td>
                                            <td>{{ $item->observacion }}</td>
                                            <td>
                                                <a href="{{ route('personas.proyectourbanizacions.print', $item->id) }}" target="_blank" title="Imprimir" class="btn btn-outline-success btn-sm"><i class="fas fa-print"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{-- @include('persona.partials.actions') --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('personas.proyectourbanizacions.store', $id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="input-categoriaurbanizacion_id" name="categoriaurbanizacion_id">
        <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-agregar">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar proyecto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hiden="true">x</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="superficiemts2">Superficie en m<sup>2</sup></label>
                                <input type="number" name="superficiemts2" id="input-superficiemts2" class="form-control" value="" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-precio">Precio por m<sup>2</sup></label>
                                <input type="text" name="costo_pu_categoria" id="input-precio" class="form-control" value="" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-totalbs">Costo Bs.</label>
                                <input type="text" id="input-totalbs" name="totalbs" class="form-control" value="" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="propietario">Nombre del propietario</label>
                                <input type="text" name="propietario" class="form-control" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="proyecto">Nombre del proyecto</label>
                                <textarea name="proyecto" class="form-control" rows="2" required></textarea>
                            </div>

                            <div class="col-md-12" style="margin-bottom: 20px">
                                @php
                                    $gestion = App\Gestion::where('deleted_at', null)
                                                        ->whereRaw('((gestion >= '.date('Y', strtotime($persona->ultimo_pago.'-01')).' and 12 <> '.date('m', strtotime($persona->ultimo_pago.'-01')).') or gestion > '.date('Y', strtotime($persona->ultimo_pago.'-01')).')')
                                                        ->limit(1)->orderBy('gestion')->first();
                                    $mes = substr($persona->ultimo_pago, -2);
                                    $mes = $mes == 12 ? 0 : intval($mes);
                                @endphp
                                <a class="btn btn-link btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-plus"></i> Agregar pago de mensualidad ({{ $gestion->gestion }})</a>
                                <div class="collapse" id="collapseExample">
                                    <input type="hidden" name="gestion_id" value="{{ $gestion->id }}">
                                    <input type="hidden" name="gestion_precio" value="{{ $gestion->mensualidad }}">
                                    <input type="hidden" name="gestion_mes" value="{{ $mes +1 }}" />
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="gestion_cantidad">Cantidad de mensualidades</label>
                                            <input type="number" id="input-gestion_cantidad" name="gestion_cantidad" value="0" min="0" max="{{ 12 - $mes }}" step="1" data-gestion='@json($gestion)' class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="gestion_total">Pago de mensualidad</label>
                                            <input type="number" id="input-gestion_total" name="gestion_total" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sucursal_id">Sucursal</label>
                                <select name="sucursal_id" class="form-control">
                                    @foreach (App\Sucursal_user::where('user_id', Auth::user()->id)->get() as $item)
                                    <option value="{{ $item->sucursal_id }}">{{ $item->sucursal->sucursal }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fecharegistro">Fecha de registro</label>
                                <input type="date" name="fecharegistro" class="form-control" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="observacion">Observaciones</label>
                                <textarea name="observacion" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">cerrar</button>
                        <button type="submit" class="btn btn-outline-success">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push ('styles')
    <link href="{{ asset('theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
    <style>

    </style>
@endpush

@push ('script')
    <script src="{{asset('theme/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

    <script>
        $('#dataTable').DataTable({"order":[[0, 'desc']],"language":{"sEmptyTable":"No hay datos disponibles en la tabla","sInfo":"Mostrando _START_ a _END_ de _TOTAL_ entradas","sInfoEmpty":"Mostrando 0 a 0 de 0 entradas","sInfoFiltered":"(Filtrada de _MAX_ entradas totales)","sInfoPostFix":"","sInfoThousands":",","sLengthMenu":"Mostrar _MENU_ entradas","sLoadingRecords":"Cargando...","sProcessing":"Procesando...","sSearch":"Buscar:","sZeroRecords":"No se encontraron registros coincidentes","oPaginate":{"sFirst":"Primero","sLast":"\u00daltimo","sNext":"Siguiente","sPrevious":"Anterior"},"oAria":{"sSortAscending":": Activar para ordenar la columna ascendente","sSortDescending":": Activar para ordenar la columna descendente"}},"columnDefs":[{"targets":"dt-not-orderable","searchable":false,"orderable":false}]});
        
        $(document).ready(function(){

            $('#input-superficiemts2').keyup(function(){
                let cantidad = $(this).val() ? parseFloat($(this).val()) : 0;
                calcularTotal(cantidad);
            });

            $('#input-superficiemts2').change(function(){
                let cantidad = $(this).val() ? parseFloat($(this).val()) : 0;
                calcularTotal(cantidad);
            });

            $('#input-gestion_cantidad').keyup(function(){
                let cantidad = $(this).val() ? parseFloat($(this).val()) : 0;
                let gestion = $(this).data('gestion');
                $('#input-gestion_total').val(gestion.mensualidad * cantidad);
            });

            $('#input-gestion_cantidad').change(function(){
                let cantidad = $(this).val() ? parseFloat($(this).val()) : 0;
                let gestion = $(this).data('gestion');
                $('#input-gestion_total').val(gestion.mensualidad * cantidad);
            });
        });

        function calcularTotal(cantidad){
            var categorias = @json($categorias);
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
                $('#input-precio').val(new Intl.NumberFormat().format(parseFloat(categoria.costo_pu).toFixed(2)));
                $('#input-totalbs').val(new Intl.NumberFormat().format(parseFloat(cantidad * categoria.costo_pu).toFixed(2)));
                $('#input-categoriaurbanizacion_id').val(categoria.id);
            }
        }
    </script>
@endpush






