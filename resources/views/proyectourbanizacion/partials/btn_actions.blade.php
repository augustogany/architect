<td>
    <a href="{{asset('http://localhost/architec/public/storage/'.$archivo)}}" target="_blank"  class="btn btn-outline-success" title="Descargar documento."><i class="fa fa-download"></i></a>

    @can('proyecto_urbanizacion.show')
    <a href="{{route('proyectourbanizacion.show',$id)}}" title="Ver proyecto." class="btn btn-outline-success"><i class="fas fa-eye"></i></a>
    @endcan

    @can('proyecto_urbanizacion.edit')
    <a href="{{route('proyectourbanizacion.edit',$id)}}" title="Editar proyecto." class="btn btn-outline-success"><i class="fas fa-edit"></i></a>
    @endcan
</td>