@extends('layouts.app')
@section('title','Crear Venta de Servicios')
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
<form id="form" action="{{route('ventaservicio.store')}}" method="POST">
    @csrf
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card" style="background-color: #8FBC8F">
				<div class="card-header">
                    <i class="fas fa-pencil-alt"></i>
					Registrar Venta de Servicios CADBENI.
                    <div class="card-tools">
                        <a href="{{ route('ventaservicio.index') }}"><button type="button" class="btn btn-light btn-lg" title="Volver a la lista de ventas."><i class="fas fa-history"></i></button></a>
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
                        <div class="col-sm-5">
                            <div class="form-group">
                                <div class="form-line">
                                    <select id="servicio_id" class="form-control form-control-sm">
                                        <option selected disabled value="">Seleccionar Concepto Venta</option>
                                        @foreach ($servicios as $servicio)
                                          <option value="{{$servicio->id}}_{{$servicio->precio}}">{{$servicio->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small>Concepto de Venta.</small>
                            </div>
                        </div>
                        <!-- input axiliar -->
                        <input type="hidden" id="servicio_id_input" class="form-control">
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" readonly id="precioservicio" class="form-control form-control-sm" placeholder="PRECIO.">
                                </div>
                                <small>Precio Concepto</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="cantidad" class="form-control form-control-sm" placeholder="CANTIDAD.">
                                </div>
                                <small>Cantidad.</small>
                            </div>
                        </div>
                         <!-- === -->
                        @php
                            $f_registro = date("Y-m-d");
                        @endphp
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" id="fechapagoservicio" class="form-control form-control-sm" value="{{$f_registro}}">
                                </div>
                                <small>Fecha de Pago.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="observacionventa" class="form-control form-control-sm" placeholder="OBSERVACION." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Observación.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <button type="button" id="bt_add" class="btn btn-danger" title="Agregar concepto de venta."><i class="fas fa-plus"></i> Agregar Concepto de Venta</button>
                                </div>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                        <table id="detalles" class="table table-bordered table-striped" style="font-size: 10pt">
                            <thead style="background-color: #6c757d; color: white;">
                              <th>Opción</th>
                              <th>Concepto</th>
                              <th>Código</th>
                              <th>Precio</th>
                              <th>Cantidad</th>
                              <th>Observación</th>
                              <th style="width: 80pt">Fecha pago</th>
                              <th>SubTotal</th>
                            </thead>
                            <tfoot>
                              <th colspan="7" style="text-align:right"><h5>TOTAL</h5></th>
                              <th><h4 id="total">Bs. 0.00</h4></th>
                            </tfoot>
                        </table>
                        </div>
                    </div>
                </div>
				<div class="card-footer" id="guardar">
                    @include('ventaservicio.partials.actions')
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
        $("#servicio_id").change(mostrarValoresServicios);
        function mostrarValoresServicios()
        {
            datoServicio = document.getElementById('servicio_id').value.split('_');
            $("#servicio_id_input").val(datoServicio[0]);
            $("#precioservicio").val(datoServicio[1]);
        }

        //variables.
        var cont=0;
        total=0;
        subtotal=[];

        //funcion limpiar.
        function limpiar()
        {
            $("#precioservicio").val("");
            $("#cantidad").val("");
            $("#observacionventa").val("");
        }

        //funcion evaluar boton guardar.
        $("#guardar").hide();
        function evaluar()
        {
            if(calcular_total()>0) {
              $("#guardar").show();
            }else {
              $("#guardar").hide();
            }
        }

        //eliminar filas en la tabla
        function eliminar(index)
        {
            total=total-subtotal[index];
            $("#total").html("Bs/." + total);
            $("#fila" + index).remove();
            $("#total").html("Bs. "+calcular_total().toFixed(2));
            evaluar();
      
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

        //funcion agregar datos a la tabla.
        function agregar()
        {

            servicio_id=$("#servicio_id_input").val();
            nombre_servicio=$("#servicio_id option:selected").text();
            precioservicio=$("#precioservicio").val();
            cantidad=$("#cantidad").val();
            observacionventa=$("#observacionventa").val();
            fechapagoservicio=$("#fechapagoservicio").val();

            let encontrado = false;

            $('.input-servicio_id').each(function(){
              if($(this).val() == servicio_id){
                encontrado = true;
              }
            });
            
            if(encontrado){
                alert("Error, El Concepto de pago que desea agregar ya se encuentra en el detalle de venta.");
                $("#precioservicio").val("");
                $("#cantidad").val("");
                $("#observacionventa").val("");
                return;
            }

            if (nombre_servicio!="" && cantidad>0) {

                subtotal = precioservicio*cantidad;
                //console.log(subtotal);

                var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" title="Quitar item del detalle de venta." class="btn btn-danger" onclick="eliminar('+cont+')";><i class="fas fa-trash"></i></button></td><td><input type="hidden" value="'+servicio_id+'">'+nombre_servicio+'</td><td><input type="hidden" class="input-servicio_id" name="servicio_id[]" value="'+servicio_id+'">'+servicio_id+'</td><td><input type="hidden" name="precioservicio[]" value="'+precioservicio+'">'+precioservicio+'</td><td><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td><td><input type="hidden" name="observacionventa[]" value="'+observacionventa+'">'+observacionventa+'</td><td><input type="hidden" name="fechapagoservicio[]" value="'+fechapagoservicio+'">'+fechapagoservicio+'</td><td><input type="hidden" class="input_subtotal" name="totalbs[]" value="'+subtotal+'">'+subtotal+'</td></tr>';

                    cont++;
                    limpiar();
                    $('#detalles').append(fila);
                    $("#total").html("Bs. "+calcular_total().toFixed(2));
                    evaluar();
                    $('#btn_guardar').removeAttr('disabled');
            }else {
              alert("** Error, Revisar el Formulario **\n- Debe seleccionar un Arquitecto del CADBENI o Tipo de Pago.\n- Debe seleccionar Concepto de Pago.\n- Debe Introducir Cantidad (Las cantidades deben ser mayor a cero).");
              }
        }

        $('#form').on('submit', function(e) {
            $('.loader').css('display', 'block')
        });
        
    </script>
@endpush






