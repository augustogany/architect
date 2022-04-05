@can('tipopago.edit')
<a href="{{route('tipopagos.edit',$id)}}" title="Editar tipo de pago." class="btn btn-outline-success"><i class="fas fa-edit"></i></a>
@endcan

@can('tipopago.destroy')
<a data-target="#modal-delete{{$id}}" data-toggle="modal" title="Habilitar/Inhabilitar tipo de pago." type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
@endcan

@include('configuracion.tipopago.modal')