@extends('layouts.app')
@section('title','Pago de mensualidad')

@section('content')
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-th-list"></i> Lista de mensualidades pagadas
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
                                        <th>Fecha de pago</th>
                                        <th>Cant. cuotas</th>
                                        <th>Subtotal</th>
                                        <th>Descuento</th>
                                        <th>Total</th>
                                        <th>Observaciones</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $months = ['', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
                                    @endphp
                                    @forelse ($pagos as $item)
                                        <tr>
                                            <td>{{ str_pad($item->id, 5, "0", STR_PAD_LEFT) }}</td>
                                            <td>{{ $item->sucursal->sucursal }}</td>
                                            <td>{{ date('d', strtotime($item->fecha_pago)).'/'.$months[intval(date('m', strtotime($item->fecha_pago)))].'/'.date('Y', strtotime($item->fecha_pago)) }}</td>
                                            <td>{{ $item->mensualidades->count() }}</td>
                                            <td>{{ number_format($item->mensualidades->sum('monto_pagado'), 2, ',', '.') }}</td>
                                            <td>{{ number_format($item->descuento, 2, ',', '.') }}</td>
                                            <td>{{ number_format($item->mensualidades->sum('monto_pagado') - $item->descuento, 2, ',', '.') }}</td>
                                            <td>{{ $item->observacion }}</td>
                                            <td>
                                                <a href="{{ route('personas.pagomensualidad.print', $item->id) }}" target="_blank" title="Imprimir" class="btn btn-outline-success btn-sm"><i class="fas fa-print"></i></a>
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

    <form action="{{ route('personas.pagomensualidad.store', $id) }}" method="POST">
        @csrf
        <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-agregar">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar pago</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hiden="true">x</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="gestion_id">Gestión</label>
                                        <select name="gestion_id" id="select-gestion_id" class="form-control" required>
                                            <option value="">Seleccione la gestión</option>
                                            @php
                                                $gestiones = App\Gestion::where('deleted_at', null)
                                                                ->whereRaw('((gestion >= '.date('Y', strtotime($persona->ultimo_pago.'-01')).' and 12 <> '.date('m', strtotime($persona->ultimo_pago.'-01')).') or gestion > '.date('Y', strtotime($persona->ultimo_pago.'-01')).')')
                                                                ->limit(1)->orderBy('gestion')->get()
                                            @endphp
                                            @foreach ($gestiones as $item)
                                            <option value="{{ $item->id }}" data-item='@json($item)'>{{ $item->gestion }} - Bs. {{ $item->mensualidad }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="table-responsive">
                                            <table id="tabla-meses" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th><small><b>Mes</b></small></th>
                                                        <th><small><b>Costo</b></small></th>
                                                        <th><small><b>Estado</b></small></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $cont = 1;
                                                    @endphp
                                                    @foreach (['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $item)
                                                        <tr>
                                                            <td class="td-input" id="td-input-{{ $cont }}">
                                                                <input type="checkbox" name="mes[]" value="{{ $cont }}" class="checkbox-mes" data-id="{{ $cont }}" id="checkbox-mes-{{ $cont }}" class="checkbox-mes" style="transform: scale(1.3);" disabled>
                                                            </td>
                                                            <td>{{ $item }}</td>
                                                            <td class="td-mensualidad text-right" id="td-mensualidad-{{ $cont }}"></td>
                                                            <td class="td-estado text-center" id="td-estado-{{ $cont }}"></td>
                                                        </tr>
                                                        @php
                                                            $cont++;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td><small><b>Subtotal</b></small></td>
                                                        <td colspan="2" class="text-right"><b id="label-subtotal">0.00</b></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td><small><b>Desc.</b></small></td>
                                                        <td colspan="2" class="text-right">
                                                            <b id="label-descuento">0.00</b>
                                                            <input type="hidden" name="descuento" id="input-descuento">
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td><small><b>Total</b></small></td>
                                                        <td colspan="2" class="text-right"><b id="label-total">0.00</b></td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                                        <label for="fecha_pago">Fecha de pago</label>
                                        <input type="date" name="fecha_pago" class="form-control" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
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
        
                <form action="{{ route('personas.pagomensualidad.destroy', $id) }}" method="POST" id="deleteForm">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <h5>¿Desea anular este pago de mensualidades?</h5>
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
        #tabla-meses td{
            padding: 3px 12px !important
        }
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
            var item;
            var mensualidad = 0;
            var personId = "{{ $id }}";
            var ultimoPago = new Date("{{ $persona->ultimo_pago.'-01' }}T00:00:00");

            $('#select-gestion_id').change(function(){
                $(`.checkbox-mes`).removeAttr('disabled');
                let gestionId = $('#select-gestion_id option:selected').val();
                item = $('#select-gestion_id option:selected').data('item');
                mensualidad = item.mensualidad;
                $('.td-mensualidad').text(mensualidad);
                
                let url = "{{ url('') }}";
                $.get(`${url}/personas/${personId}/pagomensualidad/list/${gestionId}`, function(res){
                    if(res.length > 0){
                        res.map(item => {
                            // $(`#checkbox-mes-${item.mes}`).attr('disabled', 'disabled');
                            $(`#td-estado-${item.mes}`).html('<span class="badge bg-success">Pagado</span>');
                        });
                    }else{
                        $(`.checkbox-mes`).removeAttr('disabled');
                        $(`.td-estado`).empty();
                    }

                    // Inhabilitar meses que se hayan pagado del año actual (solo en caso de iniciar con los pagos)
                    if(ultimoPago.getFullYear() == item.gestion){
                        for (let index = 1; index <= ultimoPago.getMonth() +1; index++) {
                            $(`#checkbox-mes-${index}`).attr('disabled', 'disabled');
                            $(`#checkbox-mes-${index}`).attr('checked', 'checked');
                            $(`#td-estado-${index}`).html('<span class="badge bg-success">Pagado</span>');
                            
                        }
                    }
                });
            });

            $('.checkbox-mes').click(function(e){
                let id = $(this).data('id');
                var fail = false;

                if($(this).is(':checked')){
                    $('.checkbox-mes').each(function(){
                        if (!$(this).is(':checked')) {
                            if($(this).data('id') < id){
                                e.preventDefault();
                                fail = true;
                            }
                        }
                    });
                    $(`#td-input-${id}`).append(`<input type="hidden" name="monto_pagado[]" value="${mensualidad}" id="input-monto_pagado-${id}" />`);
                }else{
                    $('.checkbox-mes').each(function(){
                        if ($(this).is(':checked')) {
                            if($(this).data('id') > id){
                                e.preventDefault();
                                fail = true;
                            }
                        }
                    });
                    $(`#input-monto_pagado-${id}`).remove();
                }

                if(fail){
                    return 0;
                }

                // Descuentos
                var descuentos = [
                    {cantidad: 6, monto: mensualidad *1},
                    {cantidad: 12, monto: mensualidad *2},
                ];
                var cont = 0;

                $('.checkbox-mes').each(function(){
                    if($(this).is(':checked') && !$(this).attr('disabled')){
                        cont++;
                    }
                });

                var descuento;
                descuentos.map(item => {
                    if(cont >= item.cantidad ){
                        descuento = item;
                    }
                });

                let monto_descuento = 0;
                // if(descuento){
                //     monto_descuento = descuento.monto;
                // }

                let subtotal = cont * mensualidad
                $('#label-subtotal').text(parseFloat(subtotal).toFixed(2));
                $('#label-descuento').text(parseFloat(monto_descuento).toFixed(2));
                $('#input-descuento').val(monto_descuento);
                $('#label-total').text(parseFloat(subtotal - monto_descuento).toFixed(2));
            });

            $('.btn-delete').click(function(){
                let id = $(this).data('id');
                $('#deleteForm input[name="id"]').val(id)
            });
        });
    </script>
@endpush






