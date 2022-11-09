<div class="dropdown" style="display:inline-block;">
    <button class="btn btn-outline-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-plus"></i></button>
    <div class="dropdown-menu">
        <a href="{{ route('personas.pagomensualidad.index', $id) }}" title="Pagos de mensualidad" class="dropdown-item">Pagos de mensualidad</a>
        <a href="{{ route('personas.proyectogenerales.index', $id) }}" title="Proyectos generales" class="dropdown-item">Visaciones</a>
        <a href="{{ route('personas.proyectourbanizacions.index', $id) }}" title="Proyectos de urbanización" class="dropdown-item">Proyectos de urbanización</a>
        <a href="{{ route('personas.ventaservicio.index', $id) }}" title="Venta de carpetas" class="dropdown-item">Venta de carpetas</a>
    </div>
</div>

@can('personas.show')
{{-- <a href="{{ route('personas.show', $id) }}" title="Ver persona" class="btn btn-outline-success btn-sm"><i class="fas fa-eye"></i></a> --}}
@endcan
@can('personas.edit')
<a href="{{ route('personas.edit', $id) }}" title="Editar persona" class="btn btn-btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
@endcan
@can('personas.destroy')
<a data-target="#modal-delete{{$id}}" data-toggle="modal" title="Eliminar persona" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash text-white"></i></a>
@endcan

@include('persona.modal')