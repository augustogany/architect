@extends('layouts.app')
@section('title','Crear Nuevo Tipo de Pago')

@section('content')

<form action="{{route('tipopagos.store')}}" method="POST">
@csrf
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card" style="background-color: #8FBC8F">
				<div class="card-header">
                    <i class="fas fa-pencil-alt"></i>
					Registrar Tipo de Pago.
				</div>


				<div class="card-body" style="background-color: #F0F8FF">
					@if(Session::has('notice'))
                    <div class="alert alert-danger">
                      <ul>
                        <li>
                           <p>{{ Session::get('notice')}}</p>
                        </li>
                      </ul>
                    </div>
                    @endif

                    <div class="row">
                    	<!-- === -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <select required name="sucursal_id" class="form-control form-control-sm">
                                        @foreach ($sucursales as $sucursal)
                                          <option value="{{$sucursal->id}}">{{$sucursal->sucursal}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small>Sucursales.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required name="nombrepago" class="form-control form-control-sm" placeholder="Nombre tipo de pago." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Nombre Tipo de Pago.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" onkeypress="if (this.value.length==4) return false;" name="gestion" class="form-control form-control-sm" placeholder="GESTION">
                                </div>
                                <small>Gestión</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input id="monto" type="number" required name="monto" class="form-control form-control-sm"  placeholder="MONTO PAGO.">
                                </div>
                                <small>Monto de Pago.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input id="descuentoporcentaje" type="number" required name="descuentoporcentaje" class="form-control form-control-sm" placeholder="DESCUENTO %.">
                                </div>
                                <small>Descuento Porcentaje.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input id="descuentobs" type="number" required name="descuentobs" class="form-control form-control-sm" placeholder="DESCUENTO Bs." readonly>
                                </div>
                                <small>Descuento Bs.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" required name="cuotas" class="form-control form-control-sm" placeholder="CUOTAS.">
                                </div>
                                <small>Cuotas de Pago.</small>
                            </div>
                        </div>
                        <!-- === -->
                    </div>
				</div>
				<div class="card-footer">
                    @include('configuracion.tipopago.partials.actions')
				</div>

			</div>
		</div>
	</div>
</div>
</form>
@endsection
@push('script')
<script>
$("#descuentoporcentaje").keypress(function(event) {
    //if ( event.which == 13 ) {
        //event.preventDefault();
        if ($("#monto").val() == '') {
            return alert('Ingrese el monto de pago porfavor');
        }
        let descuento = ($("#monto").val() * $("#descuentoporcentaje").val()) / 100;
        $("#descuentobs").val(descuento);
    //}
});
</script>
@endpush







