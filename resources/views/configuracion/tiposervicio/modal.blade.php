<form action="{{route('tiposervicios.destroy',$id)}}" method="POST">
{{method_field('delete')}}
{{csrf_field()}}
  <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete{{$id}}">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-bell"></i> Confirmar si desea aplicar acción!</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hiden="true">x</span>
        </button>
        </div>

        <div class="modal-body">
          @if($estado == "ACTIVO")
            <h5><i class="fas fa-exclamation-circle"></i> Desea deshabilitar este tipo de servicio?<br> {{$nombre}}</h5>
          @else
            <h5><i class="fas fa-exclamation-circle"></i> Desea activar este tipo de servicio?<br>{{$nombre}}</h5>
          @endif
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">cerrar</button>
          <button type="submit" class="btn btn-outline-light">Confirmar</button>
        </div>
      </div>
    </div>
  </div>
</form>



