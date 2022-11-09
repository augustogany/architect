@extends('layouts.app')
@section('title','Pago de mensualidad')

@section('content')
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-th-list"></i> Lista de proyectos generales
                        <div class="card-tools">
                            <a href="{{ route('personas.index') }}" class="btn btn-outline-dark" title="Volver a la lista">Volver <i class="fas fa-list"></i></a>
                            <a href="#" data-toggle="modal" data-target="#modal-edit-add" class="btn btn-outline-success btn-add" title="Agregar nuevo pago">Agregar <i class="fas fa-plus"></i></a>
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
                                        <th>Categoría</th>
                                        <th>Proyecto</th>
                                        <th>Total</th>
                                        <th>Archivos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($proyectos as $item)
                                        <tr>
                                            <td>{{ str_pad($item->id, 5, "0", STR_PAD_LEFT) }}</td>
                                            <td>{{ $item->sucursal->sucursal }}</td>
                                            <td>{{ date('d/M/Y', strtotime($item->fecharegistro)) }}</td>
                                            <td>{{ $item->categoriageneral->nombre }}</td>
                                            <td>{{ $item->proyecto }} <hr style="margin:0px"> <small>{{ $item->superficiemts2 }} M<sup>2</sup> - {{ $item->propietario }}</small> </td>
                                            <td>{{ number_format($item->totalbs, 2, ',', '.') }}</td>
                                            <td>
                                                @php
                                                    $cont = 1;
                                                @endphp
                                                @forelse (json_decode($item->archivo) as $archivo)
                                                    <a href="{{ url('storage/'.$archivo) }}" target="_blank">Archivo {{ $cont }}</a> <br>
                                                    @php
                                                        $cont++;
                                                    @endphp
                                                @empty
                                                    <span>Ninguno</span>
                                                @endforelse
                                            </td>
                                            <td>
                                                <a href="{{ route('personas.proyectogenerales.print', $item->id) }}" target="_blank" title="Imprimir" class="btn btn-outline-success btn-sm"><i class="fas fa-print"></i></a>
                                                <a href="#" data-toggle="modal" data-target="#modal-edit-add" data-item='@json($item)' title="Editar" class="btn btn-primary btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                                <button title="Eliminar" data-toggle="modal" data-target="#modal-delete" type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $item->id }}"><i class="fas fa-trash text-white"></i></button>
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

    <form id="form" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-add">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hiden="true">x</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id">
                            <div class="form-group col-md-3 input-add">
                                <label for="select-categoriageneral_id">Categoría</label>
                                <select id="select-categoriageneral_id" name="categoriageneral_id" class="form-control" required>
                                    <option value="">Seleccione la categoría</option>
                                    @php
                                        $servicios = App\Categoriageneral::where('condicion', 1)->get();
                                    @endphp     
                                    @foreach ($servicios as $item)
                                    <option value="{{ $item->id }}" data-item='@json($item)'>{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 input-add">
                                <label for="superficiemts2">Superficie en m<sup>2</sup></label>
                                <input type="number" name="superficiemts2" id="input-superficiemts2" step="0.1" class="form-control" value="" required>
                            </div>
                            <div class="form-group col-md-3 input-add">
                                <label for="input-precio">Precio por m<sup>2</sup></label>
                                <input type="text" name="costocategoria" id="input-precio" class="form-control" value="" readonly>
                            </div>
                            <div class="form-group col-md-3 input-add">
                                <label for="input-totalbs">Costo Bs.</label>
                                <input type="text" id="input-totalbs" name="totalbs" class="form-control" value="" readonly>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="proyecto">Nombre del proyecto</label>
                                                <textarea name="proyecto" class="form-control" rows="5" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="propietario">Nombre del propietario</label>
                                                <input type="text" name="propietario" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="propietario">Documento</label>
                                                <input type="file" name="archivo[]" multiple class="form-control" accept="application/pdf">
                                            </div>
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
                            <div class="col-md-12 div-mensualidades" style="margin-bottom: 20px">
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
                            <div class="form-group col-md-12">
                                <div class="checkbox">
                                    <input id="input-switch" type="checkbox" name="estado" data-toggle="toggle" data-on="Terminado" data-off="Pendiente" data-width="100" data-offstyle="success">
                                </div>
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

    <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar si desea aplicar acción!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hiden="true">x</span>
                    </button>
                </div>
        
                <form action="{{ route('personas.proyectogenerales.destroy', $id) }}" method="POST" id="deleteForm">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <h5>¿Desea anular este registro de proyecto?</h5>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">cerrar</button>
                        <button type="submit" class="btn btn-outline-light">Confirmar</button>
                    </div>
                </form>
            
        
            </div>
        </div>
    </div>
@endsection

@push ('styles')
    <link href="{{ asset('theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/plugins/bootstrap-toggle/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <style>

    </style>
@endpush

@push ('script')
    <script src="{{asset('theme/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('theme/plugins/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>

    <script>
        $('#dataTable').DataTable({"order":[[0, 'desc']],"language":{"sEmptyTable":"No hay datos disponibles en la tabla","sInfo":"Mostrando _START_ a _END_ de _TOTAL_ entradas","sInfoEmpty":"Mostrando 0 a 0 de 0 entradas","sInfoFiltered":"(Filtrada de _MAX_ entradas totales)","sInfoPostFix":"","sInfoThousands":",","sLengthMenu":"Mostrar _MENU_ entradas","sLoadingRecords":"Cargando...","sProcessing":"Procesando...","sSearch":"Buscar:","sZeroRecords":"No se encontraron registros coincidentes","oPaginate":{"sFirst":"Primero","sLast":"\u00daltimo","sNext":"Siguiente","sPrevious":"Anterior"},"oAria":{"sSortAscending":": Activar para ordenar la columna ascendente","sSortDescending":": Activar para ordenar la columna descendente"}},"columnDefs":[{"targets":"dt-not-orderable","searchable":false,"orderable":false}]});
        
        $(document).ready(function(){

            $('.btn-add').click(function(){
                $('#form').attr('action', "{{ route('personas.proyectogenerales.store', $id) }}");
                $('#modal-edit-add .modal-title').text('Agregar proyecto');
                $('#modal-edit-add input[type="number"]').attr('required', 'required');
                $('#modal-edit-add select').attr('required', 'required');
                $('.input-add').fadeIn('fast');
                $('.div-mensualidades').fadeIn('fast');
                $('#input-switch').bootstrapToggle('off');
            });

            $('.btn-edit').click(function(){
                let item = $(this).data('item');
                $('#form').attr('action', "{{ route('personas.proyectogenerales.update', $id) }}");
                $('#modal-edit-add .modal-title').text('Editar proyecto');
                $('#modal-edit-add input').removeAttr('required');
                $('#modal-edit-add select').removeAttr('required');
                $('#modal-edit-add input[name="id"]').val(item.id);
                $('#modal-edit-add input[name="propietario"]').val(item.propietario);
                $('#modal-edit-add input[name="fecharegistro"]').val(item.fecharegistro);
                $('#modal-edit-add textarea[name="proyecto"]').val(item.proyecto);
                $('.input-add').fadeOut('fast');
                $('.div-mensualidades').fadeOut('fast');
                if(item.estado == 'pendiente'){
                    $('#input-switch').bootstrapToggle('off');
                }else{
                    $('#input-switch').bootstrapToggle('on');
                }
            });

            $('#select-categoriageneral_id').change(function(){
                let categoria = $('#select-categoriageneral_id option:selected').data('item');
                $('#input-precio').val(categoria.costo);
            });

            $('#input-superficiemts2').keyup(function(){
                let cantidad = $(this).val() ? parseFloat($(this).val()) : 0;
                let precio = $('#input-precio') ? parseFloat($('#input-precio').val()) : 0;
                $('#input-totalbs').val(Math.round((cantidad * precio).toFixed(2)));
            });

            $('#input-superficiemts2').change(function(){
                let cantidad = $(this).val() ? parseFloat($(this).val()) : 0;
                let precio = $('#input-precio') ? parseFloat($('#input-precio').val()) : 0;
                $('#input-totalbs').val(Math.round((cantidad * precio).toFixed(2)));
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

            $('.btn-delete').click(function(){
                let id = $(this).data('id');
                $('#deleteForm input[name="id"]').val(id)
            });
        });

        function calcularTotal(){
            var total = 0;
            $('.label-subtotal').each(function(){
                total += parseFloat($(this).text());
            });
            $('#label-total').text(total.toFixed(2));
        }
    </script>
@endpush