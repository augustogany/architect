@extends('layouts.app')
@section('title','Pago de mensualidad')

@section('content')
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-th-list"></i> Lista de venta de carpetas
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
                                        <th>Fecha de venta</th>
                                        <th>Cant. items</th>
                                        <th>Total</th>
                                        <th>Observaciones</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ventas as $item)
                                        <tr>
                                            <td>{{ str_pad($item->id, 5, "0", STR_PAD_LEFT) }}</td>
                                            <td>{{ $item->sucursal->sucursal }}</td>
                                            <td>{{ date('d/M/Y', strtotime($item->fecharegistro)) }}</td>
                                            <td>{{ $item->detalle->count() + ($item->persona_pago ? 1 : 0) }}</td>
                                            <td>
                                                @php
                                                    $total = 0;
                                                    foreach($item->detalle as $detalle){
                                                        $total += $detalle->precio * $detalle->cantidad;
                                                    }
                                                @endphp
                                                {{ number_format($total, 2, ',', '.') }}
                                            </td>
                                            <td>{{ $item->observacion }}</td>
                                            <td>
                                                <a href="{{ route('personas.ventaservicio.print', $item->id) }}" target="_blank" title="Imprimir" class="btn btn-outline-success btn-sm"><i class="fas fa-print"></i></a>
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

    <form action="{{ route('personas.ventaservicio.store', $id) }}" method="POST">
        @csrf
        <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-agregar">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar venta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hiden="true">x</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="select-servicio_id">Servicio</label>
                                        <select id="select-servicio_id" class="form-control">
                                            <option value="">Seleccione el servicio</option>
                                            @php
                                                $servicios = App\Servicio::where('estado', 'activo')->get();
                                            @endphp     
                                            @foreach ($servicios as $item)
                                            <option value="{{ $item->id }}" data-item='@json($item)'>{{ $item->nombre }}</option>
                                            @endforeach
                                            @php
                                                $gestion = App\Gestion::where('deleted_at', null)
                                                                ->whereRaw('((gestion >= '.date('Y', strtotime($persona->ultimo_pago.'-01')).' and 12 <> '.date('m', strtotime($persona->ultimo_pago.'-01')).') or gestion > '.date('Y', strtotime($persona->ultimo_pago.'-01')).')')
                                                                ->limit(1)->orderBy('gestion')->first()
                                            @endphp
                                            <option value="{{ $gestion->id }}" data-gestion='@json($gestion)'>PAGO DE MENSUALIDAD GESTIÓN ({{ $gestion->gestion }})</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="table-responsive">
                                            <table id="tabla-detalles" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Servicio</th>
                                                        <th>Precio</th>
                                                        <th>Cantidad</th>
                                                        <th>Subtotal</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                                <tfoot>
                                                    {{-- <tr>
                                                        <td colspan="3"><small><b>Subtotal</b></small></td>
                                                        <td class="text-right"><b id="label-subtotal">0.00</b></td>
                                                        <td></td>
                                                    </tr> --}}
                                                    {{-- <tr>
                                                        <td colspan="3"><small><b>Desc.</b></small></td>
                                                        <td class="text-right">
                                                            <b id="label-descuento">0.00</b>
                                                            <input type="hidden" name="descuento" id="input-descuento">
                                                        </td>
                                                        <td></td>
                                                    </tr> --}}
                                                    <tr>
                                                        <td colspan="3"><small><b>Total</b></small></td>
                                                        <td class="text-right"><b id="label-total">0.00</b></td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="sucursal_id">Sucursal</label>
                                        <select name="sucursal_id" class="form-control">
                                            @foreach (App\Sucursal_user::where('user_id', Auth::user()->id)->get() as $item)
                                            <option value="{{ $item->sucursal_id }}">{{ $item->sucursal->sucursal }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="fecharegistro">Fecha de venta</label>
                                        <input type="date" name="fecharegistro" class="form-control" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="observacion">Observaciones</label>
                                        <textarea name="observacion" class="form-control" rows="5"></textarea>
                                    </div>
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
        
                <form action="{{ route('personas.ventaservicio.destroy', $id) }}" method="POST" id="deleteForm">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <h5>¿Desea anular este registro de venta?</h5>
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

            $('#select-servicio_id').change(function(){
                let value = $(this).val();
                let item = $('#select-servicio_id option:selected').data('item');
                let gestion = $('#select-servicio_id option:selected').data('gestion');
                if(item){
                    if(!document.getElementById(`tr-${item.id}`)){
                        $('#tabla-detalles tbody').append(`
                            <tr id="tr-${item.id}">
                                <td>
                                    <input type="hidden" name="servicio_id[]" value="${item.id}" />
                                    <small>${item.nombre}</small>
                                </td>
                                <td>
                                    ${item.precio}
                                    <input type="hidden" name="precio[]" value="${item.precio}" />
                                </td>
                                <td>
                                    <input type="number" name="cantidad[]" class="form-control-sm input-cantidad" id="input-cantidad-${item.id}" onclick="calcular(${item.id})" data-precio="${item.precio}" value="1" min="1" step="1" style="width: 70px" required />
                                </td>
                                <td id="label-subtotal-${item.id}" class="label-subtotal text-right">${item.precio}</td>
                                <td>
                                    <button onclick="deleteTr(${item.id})" title="Eliminar" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash text-white"></i></button>
                                </td>
                            </tr>
                        `);
                        $('#select-servicio_id').val('').trigger('change');
                    }

                }else if(gestion){
                    if(!document.getElementById(`tr-gestion`)){
                        let persona = @json($persona);
                        if(persona.ultimo_pago){
                            let mes = parseInt(persona.ultimo_pago.slice(-2));
                            mes = mes == 12 ? 0 : mes;
                            $('#tabla-detalles tbody').append(`
                                <tr id="tr-gestion">
                                    <td>
                                        <input type="hidden" name="gestion_id" value="${gestion.id}" />
                                        <small>Mensualidad gestión ${gestion.gestion}</small>
                                    </td>
                                    <td>
                                        ${gestion.mensualidad}
                                        <input type="hidden" name="gestion_precio" value="${gestion.mensualidad}" />
                                        <input type="hidden" name="gestion_mes" value="${mes +1}" />
                                    </td>
                                    <td>
                                        <input type="number" name="gestion_cantidad" class="form-control-sm input-cantidad" id="input-cantidad-gestion" onclick="calcular('gestion')" data-precio="${gestion.mensualidad}" value="1" min="1" max="${12 - mes}" step="1" style="width: 70px" required />
                                    </td>
                                    <td id="label-subtotal-gestion" class="label-subtotal text-right">${gestion.mensualidad}</td>
                                    <td>
                                        <button onclick="deleteTr('gestion')" title="Eliminar" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash text-white"></i></button></td>
                                </tr>
                            `);
                            $('#select-servicio_id').val('').trigger('change');
                        }
                    }
                }
                calcularTotal();
            });

            $('.btn-delete').click(function(){
                let id = $(this).data('id');
                $('#deleteForm input[name="id"]').val(id)
            });
        });

        function calcular(id){
            let precio = parseFloat($('#input-cantidad-'+id).data('precio'));
            let cantidad = $('#input-cantidad-'+id).val() ? parseFloat($('#input-cantidad-'+id).val()) : 0;
            let subtotal = (precio * cantidad).toFixed(2);
            $('#label-subtotal-'+id).text(subtotal);
            calcularTotal();
        }

        function calcularTotal(){
            var total = 0;
            $('.label-subtotal').each(function(){
                total += parseFloat($(this).text());
            });
            $('#label-total').text(total.toFixed(2));
        }

        function deleteTr(id){
            $(`#tr-${id}`).remove();
            calcularTotal();
        }

    </script>
@endpush






