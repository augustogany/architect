<form action="{{route('personas.destroy',$id)}}" method="POST">
@csrf @method('DELETE')
  <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete{{$id}}">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
        <h5 class="modal-title">Confirmar si desea aplicar acción!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hiden="true">x</span>
        </button>
        </div>

        <div class="modal-body">
          @if($condicion == 1)
            <h5 style="text-align: center;" class="modal-title">Desea inhabilitar a: {{$nombre}} {{$apaterno}} {{$amaterno}} ?</h5>
          @else
            <h5 style="text-align: center;" class="modal-title">Desea habilitar a: {{$nombre}} {{$apaterno}} {{$amaterno}} ?</h5>
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