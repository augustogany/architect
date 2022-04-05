@can('tiposervicio.edit')
<a href="{{route('tiposervicios.edit',$id)}}" title="Editar tipo de servicio." class="btn btn-outline-success"><i class="fas fa-edit"></i></a>
@endcan

@can('tiposervicio.destroy')
<a data-target="#modal-delete{{$id}}" data-toggle="modal" title="Habilitar/Inhabilitar tipo de servicio." type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
@endcan

@include('configuracion.tiposervicio.modal')