{{-- @can('personas.edit') --}}
<a href="{{ route('personas.pagomensualidad.index', $id) }}" title="Pagar mensualidad" class="btn btn-outline-success btn-sm"><i class="fas fa-calendar"></i></a>
{{-- @endcan --}}
@can('personas.show')
<a href="{{ route('personas.show', $id) }}" title="Ver persona" class="btn btn-outline-success btn-sm"><i class="fas fa-eye"></i></a>
@endcan
@can('personas.edit')
<a href="{{ route('personas.edit', $id) }}" title="Editar persona" class="btn btn-outline-success btn-sm"><i class="fas fa-edit"></i></a>
@endcan
@can('personas.destroy')
<a data-target="#modal-delete{{$id}}" data-toggle="modal" title="Eliminar persona" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash text-white"></i></a>
@endcan

@include('persona.modal')