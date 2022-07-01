@extends('layouts.app')
@section('title','Pago de mensualidad')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-th-list"></i> Lista de mensualidades pagadas
                        <div class="card-tools">
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
                                        <th>Monto de pago</th>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pagos as $item)
                                        <tr>
                                            <td>{{ str_pad($item->id, 5, "0", STR_PAD_LEFT) }}</td>
                                            <td>{{ $item->sucursal->sucursal }}</td>
                                            <td>{{ date('d/M/Y', strtotime($item->fecha_pago)) }}</td>
                                            <td>{{ $item->mensualidades->count() }}</td>
                                            <td><small>Bs.</small> {{ number_format($item->mensualidades->sum('monto_pagado') - $item->mensualidades->sum('monto_descuento'), 2, ',', '.') }}</td>
                                            <td>{{ $item->observacion }}</td>
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
        <input type="hidden" name="monto_descuento" value="0">
        <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-agregar">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar pago</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hiden="true">x</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="gestion_id">Gestión</label>
                                <select name="gestion_id" id="select-gestion_id" class="form-control">
                                    <option value="">Seleccione la gestión</option>
                                    @foreach (App\Gestion::where('deleted_at', null)->get() as $item)
                                    <option value="{{ $item->id }}" data-mensualidad="{{ $item->mensualidad }}">{{ $item->gestion }} - Bs. {{ $item->mensualidad }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="table-responsive">
                                    <table id="tabla-meses" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Mes</th>
                                                <th>Mensualidad</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $cont = 1;
                                            @endphp
                                            @foreach (['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $item)
                                                <tr>
                                                    <td class="td-input" id="td-input-{{ $cont }}">
                                                        <input type="checkbox" name="mes[]" value="{{ $cont }}" class="checkbox-mes" data-id="{{ $cont }}" id="checkbox-mes-{{ $cont }}" class="checkbox-mes" style="transform: scale(1.3);">
                                                    </td>
                                                    <td>{{ $item }}</td>
                                                    <td class="td-mensualidad" id="td-mensualidad-{{ $cont }}"></td>
                                                    <td class="td-estado" id="td-estado-{{ $cont }}"></td>
                                                </tr>
                                                @php
                                                    $cont++;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
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
                                <label for="fecha_pago">Fecha de pago</label>
                                <input type="date" name="fecha_pago" class="form-control" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="observacion">Observaciones</label>
                                <textarea name="observacion" class="form-control"></textarea>
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
        $('#dataTable').DataTable({"order":[],"language":{"sEmptyTable":"No hay datos disponibles en la tabla","sInfo":"Mostrando _START_ a _END_ de _TOTAL_ entradas","sInfoEmpty":"Mostrando 0 a 0 de 0 entradas","sInfoFiltered":"(Filtrada de _MAX_ entradas totales)","sInfoPostFix":"","sInfoThousands":",","sLengthMenu":"Mostrar _MENU_ entradas","sLoadingRecords":"Cargando...","sProcessing":"Procesando...","sSearch":"Buscar:","sZeroRecords":"No se encontraron registros coincidentes","oPaginate":{"sFirst":"Primero","sLast":"\u00daltimo","sNext":"Siguiente","sPrevious":"Anterior"},"oAria":{"sSortAscending":": Activar para ordenar la columna ascendente","sSortDescending":": Activar para ordenar la columna descendente"}},"columnDefs":[{"targets":"dt-not-orderable","searchable":false,"orderable":false}]});
        
        $(document).ready(function(){
            var mensualidad = 0;
            var personId = "{{ $id }}";
            $('#select-gestion_id').change(function(){
                let gestionId = $('#select-gestion_id option:selected').val();
                mensualidad = $('#select-gestion_id option:selected').data('mensualidad');
                $('.td-mensualidad').text(mensualidad);
                
                let url = "{{ url('') }}";
                $.get(`${url}/personas/${personId}/pagomensualidad/list/${gestionId}`, function(res){
                    if(res.length > 0){
                        res.map(item => {
                            $(`#checkbox-mes-${item.mes}`).attr('disabled', 'disabled');
                            $(`#td-estado-${item.mes}`).html('<span class="badge bg-success"><i class="far fa-money-bill-alt"></i> Pagado</span>');
                        });
                    }else{
                        $(`.checkbox-mes`).removeAttr('disabled');
                        $(`.td-estado`).empty();
                    }
                    
                });
            });

            $('.checkbox-mes').click(function(){
                let id = $(this).data('id');
                if($(this).is(':checked')){
                    $(`#td-input-${id}`).append(`<input type="hidden" name="monto_pagado[]" value="${mensualidad}" id="input-monto_pagado-${id}" />`);
                }else{
                    $(`#input-monto_pagado-${id}`).remove();
                }
            });
        });
    </script>
@endpush






