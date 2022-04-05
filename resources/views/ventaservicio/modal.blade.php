<form action="{{route('ventaservicio.destroy',$id)}}" method="POST">
@csrf @method('DELETE')
  <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete{{$id}}">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        @if($estado == "ACTIVO")
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-bell"></i> Confirmar si desea aplicar acción!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hiden="true">x</span>
          </button>
        </div>
        
        <div class="modal-body">
          <h5><i class="fas fa-exclamation-circle"></i> ¿Desea anular esta venta de servicio? una vez confirmada la acción no podrá volver a activarla.</h5>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">cerrar</button>
          <button type="submit" class="btn btn-outline-light">Confirmar</button>
        </div>
        @else
         <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Acción no permitida.</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hiden="true">x</span>
          </button>
        </div>
        
        <div class="modal-body">
          <h5><i class="fas fa-exclamation-circle"></i> Esta venta ya ha sido anulada de manera permanente, contactar al administrador del sistema.</h5>
        </div>
        @endif
      </div>
    </div>
  </div>
</form>