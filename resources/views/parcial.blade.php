<a href="{{route('pdfdetalleventa',$id)}}" title="Imprimir Detalle de Venta" target="_blank" class="btn btn-outline-success"><i class="fas fa-print"></i></a>

@can('ventaservicio.destroy') 
<a data-target="#modal-delete{{$id}}" data-toggle="modal" title="Anular Venta" type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
@endcan

@include('ventaservicio.modal')


var tableVentas  = $('#ventaservicioTable').DataTable();

        tableVentas.on('click', '.delete', function(){

          $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) 
            {
              $tr = $tr.prev('.parent');
            }

          var data = tableVentas.row($tr).data();
          console.log(data);

          $('#id').val(data[0]);

          $('#deleteForm').attr('action', 'ventaservicio/'+data[0]);
          $('#modal-delete').modal();
        });


        =================================

          <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
        <h5 class="modal-title">Confirmar si desea aplicar acción!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hiden="true">x</span>
        </button>
        </div>

        <form action="ventaservicio" method="POST" id="deleteForm">
          @csrf @method('DELETE')
           <div class="modal-body">
          <h5>¿Desea anular esta venta de servicio?</h5>
          <input type="hidden" name="_method" value="DELETE">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">cerrar</button>
          <button type="submit" class="btn btn-outline-light">Confirmar</button>
        </div>
        </form>
       

      </div>
    </div>
  </div>

  ======================================
  var tableVentas  = $('#ventaservicioTable').DataTable();

        tableVentas.on('click', '.delete', function(){
          $('#modal-delete').modal();

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          console.log(data);

          $('#delete_id').val(data[0]);
        });

        $('#deleteForm').on('submit', function(e){
          e.preventDefault();

          var id = $('#delete_id').val();

          $.ajax({
            type: "DELETE",
            url: "ventaservicio/"+id,
            data: $('#deleteForm').serialize(),
            success: function(response){
              console.log(response);
              $('#modal-delete').modal('hide');
              //alert("Data Deleted");
            },
            error: function(error){
              //console.log(error);
            }
          });

        });

        <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete">
  <div class="modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
      <h5 class="modal-title">Confirmar si desea aplicar acción!</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hiden="true">x</span>
      </button>
      </div>

      <form id="deleteForm">
        @csrf @method('DELETE')
         <div class="modal-body">
        <h5>¿Desea anular esta venta de servicio?</h5>
        <input type="text" name="id" id="delete_id">
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">cerrar</button>
        <button type="submit" class="btn btn-outline-light">Confirmar</button>
      </div>
      </form>
     

    </div>
  </div>
</div>
===============================================================

public function data()
{
    $customers = Customer::all();
    return datatables()->of($customers)
        ->addColumn('action', function ($row) {
            $html = '<a href="#" class="btn btn-xs btn-secondary">Edit</a> ';
            $html .= '<button data-rowid="'.$row->id.'" class="btn btn-xs btn-danger">Del</button>';
            return $html;
        })->toJson();
}
