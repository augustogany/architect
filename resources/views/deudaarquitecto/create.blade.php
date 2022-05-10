@extends('layouts.app')
@section('title','Crear Nueva Deuda')
<style>
    .loader{
        text-align: center;
        color:#ff6e4a;
        display: none
    }
</style>
@section('content')
<div class="loader">
    <h4>Por favor espere, Se está guardando el archivo... <img src="{{asset('theme/dist/img/loader.gif')}}" width="100px"> </h4>
</div>
<form id="form" action="{{route('deudaarquitectos.store')}}" method="POST">
    @csrf
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card" style="background-color: #8FBC8F">
				<div class="card-header">
                    <i class="fas fa-pencil-alt"></i>
					Registrar Deuda de Arquitecto del CADBENI.
                    <div class="card-tools">
                        <a href="{{ route('deudaarquitectos.index') }}"><button type="button" class="btn btn-light btn-lg" title="Volver a la lista de deudas."><i class="fas fa-history"></i></button></a>
                    </div>
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
                                    <select required id="persona_id" class="form-control form-control-sm select2">
                                        <option selected disabled value="">Seleccionar Arquitecto</option>
                                        @foreach ($personas as $persona)
                                          <option value="{{$persona->id}}_{{$persona->numeroregistro}}">{{$persona->numeroregistro}} - {{$persona->nombre}} {{$persona->apaterno}} {{$persona->amaterno}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small>Arquitectos.</small>
                            </div>
                        </div>
                        <!-- input axiliar -->
                        <input type="hidden" id="persona_id_input" name="persona_id_input" class="form-control">
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly class="form-control form-control-sm" required id="numeroregistro" placeholder="NRO. REGISTRO." autocomplete="off">
                                </div>
                                <small>Número de Registro.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <select required id="tipopago_id" class="form-control form-control-sm select2">
                                        <option selected disabled value="">Seleccionar Tipo de Pago</option>
                                        @foreach ($tipopagos as $tipopago)
                                          <option value="{{$tipopago->id}}_{{$tipopago->monto}}_{{$tipopago->descuentoporcentaje}}_{{$tipopago->descuentobs}}_{{$tipopago->cuotas}}">{{$tipopago->nombrepago}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small>Tipo de Pago.</small>
                            </div>
                        </div>
                        <!-- input axiliar -->
                        <input type="hidden" id="tipopago_id_input" name="tipopago_id_input" class="form-control">
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required readonly id="monto" name="montodeuda" class="form-control form-control-sm" placeholder="MONTO.">
                                </div>
                                <small>Monto.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required readonly id="descuentoporcentaje" name="descuentoporcentaje" class="form-control form-control-sm" placeholder="DESCUENTO %.">
                                </div>
                                <small>Descuento %.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly id="descuentobs" name="descuentobs" class="form-control form-control-sm"  placeholder="DESCUENTO BS.">
                                </div>
                                <small>Descuento Bs.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly id="cuotas" name="cuotas" class="form-control form-control-sm" placeholder="CUOTAS." required>
                                </div>
                                <small>Cuotas.</small>
                            </div>
                        </div>
                        <!-- === -->
                        @php
                            $f_registro = date("Y-m-d");
                        @endphp
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" class="form-control form-control-sm" name="fecharegistro" value="{{$f_registro}}">
                                </div>
                                <small>Fecha de Registro.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="observacion" class="form-control form-control-sm" placeholder="OBSERVACION." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Observación.</small>
                            </div>
                        </div>
                        <!-- === -->
                    </div>
				</div>
       
                <div class="card-body" style="background-color: #F0F8FF">
                    <div class="row">
                        <!-- === -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <select id="mese_id" class="form-control form-control-sm">
                                        <option selected disabled value="">Seleccionar Mes de Pago</option>
                                        @foreach ($meses as $mes)
                                          <option value="{{$mes->id}}">{{$mes->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small>Mes a Pagar.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number"  id="preciomes" class="form-control form-control-sm" placeholder="PRECIO MES." onkeyup="validar_monto(this)">
                                </div>
                                <small>Precio Mes.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="observacioncuota" class="form-control form-control-sm" placeholder="OBSERVACION." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Observación.</small>
                            </div>
                        </div>
                        <!-- === -->
                        @php
                            $f_registro = date("Y-m-d");
                        @endphp
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" id="fechapagomes" class="form-control form-control-sm" value="{{$f_registro}}">
                                </div>
                                <small>Fecha de Pago.</small>
                            </div>
                        </div>
                        <!-- === -->

                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <button type="button" id="bt_add" class="btn btn-danger" title="Agregar cuota."><i class="fas fa-plus"></i> Agregar Cuota</button>
                                </div>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                        <table id="detalles" class="table table-bordered table-striped" style="font-size: 10pt">
                            <thead style="background-color: #6c757d; color: white;">
                              <th>Opción</th>
                              <th>Mes a pagar</th>
                              <th>Código</th>
                              <th>Precio mes</th>
                              <th>Observación</th>
                              <th>Fecha pago</th>
                              <th>SubTotal</th>
                            </thead>
                            <tfoot>
                              <th colspan="6" style="text-align:right"><h5>TOTAL</h5></th>
                              <th><h4 id="total">Bs. 0.00</h4></th>
                            </tfoot>
                        </table>
                        </div>
                    </div>
                </div>
				<div class="card-footer" id="guardar">
                    @include('deudaarquitecto.partials.actions')
				</div>

			</div>
		</div>
	</div>
</div>
</form>
@endsection

@push ('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('theme/plugins/select2/css/select2.min.css')}}">
@endpush

@push ('script')
    <!-- Select2 -->
    <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
        $('.select2').select2();

        $('#bt_add').click(function() {
          agregar();
        });

        //Select filtro + Personas
        $("#persona_id").change(mostrarValoresPersonas);
        function mostrarValoresPersonas()
        {
            datoPersona = document.getElementById('persona_id').value.split('_');
            $("#persona_id_input").val(datoPersona[0]);
            $("#numeroregistro").val(datoPersona[1]);
        }

        //Select filtro + extraccion de datos de los tipod de pago.
        $("#tipopago_id").change(mostrarValoresTipopago);
        function mostrarValoresTipopago()
        {
            datoTipopago = document.getElementById('tipopago_id').value.split('_');
            $("#tipopago_id_input").val(datoTipopago[0]);
            (datoTipopago[1] == 0) ? $('#monto').removeAttr('readonly') : $('#monto').prop('readonly',true);
            $("#monto").val(datoTipopago[1]);
            (datoTipopago[2] == 0) ? $('#descuentoporcentaje').removeAttr('readonly') : $('#descuentoporcentaje').prop('readonly',true);
            $("#descuentoporcentaje").val(datoTipopago[2]);
            $("#descuentobs").val(datoTipopago[3]);
            (datoTipopago[4] == 0) ? $('#cuotas').removeAttr('readonly') : $('#cuotas').prop('readonly',true);
            $("#cuotas").val(datoTipopago[4]);
            if ($("#cuotas").val() > 0 && $("#monto").val() > 0) {
                $('#btn_guardar').removeAttr('disabled');
            }else{
                $("#btn_guardar").attr('disabled',true);    
            }
            
        }
        
        $('#monto').keyup((e) => {
            if (e.currentTarget.value > 0) {
                $('#btn_guardar').removeAttr('disabled');
            } else {
                $("#btn_guardar").attr('disabled',true);
            }
            console.log(e.currentTarget.value);
        });
        $("#descuentoporcentaje").keypress(function(event) {
            if ( event.which == 13 ) {
                event.preventDefault();
                if ($("#monto").val() == '' || $("#monto").val() == 0) {
                    return alert('Ingrese el monto de pago porfavor');
                }
                let descuento = ($("#monto").val() * $("#descuentoporcentaje").val()) / 100;
                $("#descuentobs").val(descuento);
            }
        });

        $('#cuotas').keypress(function(){
            if ($("#monto").val() == '' || $("#monto").val() == 0) {
                    return alert('Ingrese el monto de pago porfavor');
            }
            $('#btn_guardar').removeAttr('disabled');
        });
        //variables.
        var cont=0;
        var monto_deuda = 0;
        total=0;
        subtotal=[];

        //funcion limpiar.
        function limpiar()
        {
            $("#mese_id").val("");
            $("#preciomes").val("");
            $("#observacioncuota").val("");
        }

        //funcion evaluar boton guardar.
        // $("#guardar").hide();
        // function evaluar()
        // {
        //     if(calcular_total()>0) {
        //       $("#guardar").show();
        //     }else {
        //       $("#guardar").hide();
        //     }
        // }

        //eliminar filas en la tabla
        function eliminar(index)
        {
            total=total-subtotal[index];
            $("#total").html("Bs/." + total);
            $("#fila" + index).remove();
            $("#total").html("Bs. "+calcular_total().toFixed(2));
            evaluar();
            $('#btn_guardar').attr('disabled', true);
        }

        //calcular total de factura
        function calcular_total()
        {
          let total = 0;
            $(".input_subtotal").each(function() {
              total += parseFloat($(this).val());
            });

            return total;
        }

        // Validacion de monto de deuda
        function validar_monto(numero)
        {
            let monto_deudaglobal = parseFloat($('#monto').val());
            let desc = parseFloat($('#descuentobs').val());
            let cuots = $('#cuotas').val();
            let monto_pagomes = parseFloat(numero.value);
            monto_pago = monto_deudaglobal - desc;
            if(cuots == 1) {
                if (numero.value.length >= 3) {
                    numero.focus();
                    numero.select();
                    if (monto_pagomes != monto_pago) {
                        $('#preciomes').val('');
                        alert("Error, El monto de las cuotas deve ser igual a: "+monto_pago+" ya que la cuota es 1");
                    }
                }
            }else if(monto_pagomes > monto_pago){
                    $('#preciomes').val('');
                    alert("Error, El monto de las cuotas deve ser menor a: "+monto_pago);
            }
           
        
        }

        //funcion agregar datos a la tabla.
        function agregar()
        {
            meses_id=$("#mese_id").val();
            nombre_mes=$("#mese_id option:selected").text();
            preciomes=$("#preciomes").val();
            observacioncuota=$("#observacioncuota").val();
            fechapagomes=$("#fechapagomes").val();

            let encontrado = false;
            let count = 0;
            $('.input-meses_id').each(function(){
              if($(this).val() == meses_id){
                encontrado = true;
              }
              count++;
            });

            if (count == $("#cuotas").val()) {
                alert("Error, No puede agregar mas cuotas de las establecidas.");
                $("#preciomes").val("");
                $("#observacioncuota").val("");
                return;
            }
            
            if(encontrado){
                alert("Error, El Mes! que desea agregar ya se encuentra en el detalle de pagos.");
                $("#preciomes").val("");
                $("#observacioncuota").val("");
                return;
            }

            if (nombre_mes!="" && preciomes>0) {

                subtotal = parseFloat(preciomes);
                //console.log(subtotal);


                var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" title="Quitar item del detalle de pago." class="btn btn-danger" onclick="eliminar('+cont+')";><i class="fas fa-trash"></i></button></td><td><input type="hidden" value="'+meses_id+'">'+nombre_mes+'</td><td><input type="hidden" class="input-meses_id" name="meses_id[]" value="'+meses_id+'">'+meses_id+'</td><td><input type="hidden" name="preciomes[]" value="'+preciomes+'">'+preciomes+'</td><td><input type="hidden" name="observacioncuota[]" value="'+observacioncuota+'">'+observacioncuota+'</td><td><input type="hidden" name="fechapagomes[]" value="'+fechapagomes+'">'+fechapagomes+'</td><td><input type="hidden" class="input_subtotal" name="totalbs[]" value="'+subtotal+'">'+subtotal+'</td></tr>';

                //captura la suma de Subtotales
                let pago_mes = parseFloat(calcular_total()+subtotal).toFixed(2);
                //let pago_mes = parseFloat($('#preciomes').val());
                //console.log(pago_mes);

                //captura el valor del monto de la factura
                monto_deuda = parseFloat($('#monto').val());

                //compara si el monto de la factura es menor o igual que el subtotal
                if (pago_mes<=monto_deuda) 
                {
                    cont++;
                    limpiar();
                    $('#detalles').append(fila);
                    $("#total").html("Bs. "+calcular_total().toFixed(2));
                    evaluar();

                    if (calcular_total().toFixed(2)<=monto_deuda.toFixed(2))
                    {
                        $('#btn_guardar').removeAttr('disabled');
                    }
              
                }else {
                  alert("Error, El monto de las cuotas por pagar excede el monto global de la deuda del arquitecto.");
                  }
            }else {
              alert("** Error, Revisar el Formulario **\n- Debe seleccionar un Arquitecto del CADBENI o Tipo de Pago.\n- Debe seleccionar Mes a Pagar.\n- Debe Introducir Precio Mes (El monto debe der mayor que cero).");
              }
        }
        //funcion para validar con el monto a pagar al agregar cuotas si tiene desc
        function validar_cuota(){

        }

        $('#form').on('submit', function(e) {
            $('.loader').css('display', 'block')
        });
        
    </script>
@endpush






