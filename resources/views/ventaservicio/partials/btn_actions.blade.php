<a href="{{route('pdfdetalleventa',$id)}}" title="Imprimir Detalle de Venta" target="_blank" class="btn btn-outline-success"><i class="fas fa-print"></i></a>

@can('ventaservicio.destroy') 
<a data-target="#modal-delete{{$id}}" data-toggle="modal" title="Anular Venta" type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
@endcan

@include('ventaservicio.modal')