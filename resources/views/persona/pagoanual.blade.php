@extends('layouts.app')
@section('title','Pagos a CENACAB')

@section('content')
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-th-list"></i> Lista de pagos CENACAB
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
                                            <td>{{ number_format($item->monto_pagado, 2, ',', '.') }}</td>
                                            <td>{{ number_format($item->monto_descuento, 2, ',', '.') }}</td>
                                            <td>{{ number_format($item->monto_pagado - $item->monto_descuento, 2, ',', '.') }}</td>
                                            <td>{{ $item->observacion }}</td>
                                            <td>
                                                <a href="{{ route('personas.pagoanual.print', $item->id) }}" target="_blank" title="Imprimir" class="btn btn-outline-success btn-sm"><i class="fas fa-print"></i></a>
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

    <form action="{{ route('personas.pagoanual.store', $id) }}" method="POST">
        @csrf
        <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-agregar">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar pago</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hiden="true">x</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
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
                                        <label for="gestion_id">Gestión</label>
                                        <select name="gestion_id" class="form-control">
                                            @foreach (App\Gestion::where('deleted_at', null)->orderBy('gestion', 'DESC')->get() as $item)
                                            <option value="{{ $item->id }}">{{ $item->gestion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="monto_pagado">Monto</label>
                                        <input type="number" name="monto_pagado" class="form-control" value="80" min="80" step="1" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="monto_descuento">Descuento</label>
                                        <input type="number" name="monto_descuento" class="form-control" value="0" min="0" max="80" step="1">
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
        
                <form action="{{ route('personas.pagoanual.destroy', $id) }}" method="POST" id="deleteForm">
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
            $('.btn-delete').click(function(){
                let id = $(this).data('id');
                $('#deleteForm input[name="id"]').val(id)
            });
        });
    </script>
@endpush






