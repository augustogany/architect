@extends('layouts.app')
@section('title','Editar Proyectos Generales')
<style>
    .loader{
        text-align: center;
        color:#ff6e4a;
        display: none
    }
</style>
@section('content')
<div class="loader">
    <h4>Por favor espere, Se está guardando el archivo! <img src="{{asset('theme/dist/img/loader.gif')}}" width="100px"> </h4>
</div>
<form id="form" action="{{route('proyectogeneral.update',$proyectogeneral->id)}}" method="POST" enctype="multipart/form-data">
    @csrf @method('PATCH')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card" style="background-color: #8FBC8F">
				<div class="card-header">
                    <i class="fas fa-edit"></i>
					Editar Proyecto
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
                        <div class="col-sm-8">
                            <div class="form-group">
                                <div class="form-line">
                                    <select required id="persona_id" name="persona_id" class="form-control form-control-sm select2">
                                        @foreach ($personas as $persona)
                                        <option value="{{$persona->id}}" {{(collect($proyectogeneral->persona_id)->contains($persona->id)) ? 'selected':''}}>{{$persona->nombre}} {{$persona->apaterno}} {{$persona->amaterno}} :: Código de registro: {{$persona->numeroregistro}} ::</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small>Arquitectos.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <select required id="categoriageneral_id" class="form-control form-control-sm select2">
                                        <option selected disabled value="">Seleccionar Categoría</option>
                                        @foreach ($categoriagenerals as $categoriageneral)
                                        <option value="{{$categoriageneral->id}}_{{$categoriageneral->costo}}" {{(collect($proyectogeneral->categoriageneral_id)->contains($categoriageneral->id)) ? 'selected':''}}>{{$categoriageneral->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small>Categorias.</small>
                            </div>
                        </div>
                        <!-- input axiliar -->
                        <input type="hidden" id="categoriageneral_id_input" name="categoriageneral_id_input" class="form-control">
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly id="costo" value="{{$proyectogeneral->costocategoria}}" name="costo" class="form-control form-control-sm calcular" required placeholder="Precio Categoría" onkeyup="calcular_monto_parcial();">
                                </div>
                                <small>Precio Categoría.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" step="0.01" name="superficiemts2" value="{{$proyectogeneral->superficiemts2}}" class="form-control form-control-sm calcular" required placeholder="Superficie" autocomplete="off" onkeyup="calcular_monto_parcial();">
                                </div>
                                <small>Superficie - M2.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="costo_parcial" readonly id="costo_parcial" value="{{$proyectogeneral->totalbs}}" class="form-control form-control-sm">
                                </div>
                                <small>Costo Parcial Proyecto:</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input 
                                        type="number" 
                                        name="descuento" 
                                        value="{{$proyectogeneral->descuento}}" 
                                        class="form-control form-control-sm" 
                                        onkeyup="calcular_monto_parcial($(this).val(),true);">
                                </div>
                                <small>Descuento.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" class="form-control form-control-sm" name="fecharegistro" value="{{$proyectogeneral->fecharegistro}}">
                                </div>
                                <small>Fecha de Registro.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="estado" class="form-control form-control-sm">
                                        <option 
                                               value="pendiente" 
                                               {{$proyectogeneral->estado == 'pendiente' ? 'selected' : ''}}
                                        >
                                            Pendiente
                                        </option>
                                        <option 
                                                value="finalizado"
                                                {{$proyectogeneral->estado == 'finalizado' ? 'selected' : ''}}
                                        >
                                            Finalizado
                                        </option>
                                    </select>
                                </div>
                                <small>Estado</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="proyecto" value="{{$proyectogeneral->proyecto}}" class="form-control form-control-sm" required placeholder="Nombre del Proyecto." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Nombre del Proyecto.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="propietario" value="{{$proyectogeneral->propietario}}" class="form-control form-control-sm" required placeholder="Propietario." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Propietario.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" id="archivoInput" name="archivo" onchange="return validarArchivo()" autocomplete="off">
                                </div>
                                <small>Archivo Adjunto.</small>
                            </div>
                        </div>
                        <!-- === -->
                    </div>
				</div>
				<div class="card-footer">
                    @include('proyectogeneral.partials.actions_update')
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

        //Select filtro + Categoria General
        $("#categoriageneral_id").change(mostrarValoresCategoriageneral);
        function mostrarValoresCategoriageneral()
        {
            datoCategoria = document.getElementById('categoriageneral_id').value.split('_');
            $("#categoriageneral_id_input").val(datoCategoria[0]);
            $("#costo").val(datoCategoria[1]);
        }

        function validarArchivo()
        {
            var archivoInput = document.getElementById('archivoInput');
            var archivoRuta = archivoInput.value;
            var extPermitidas = /(.pdf)$/i;
            if(!extPermitidas.exec(archivoRuta)){
                alert('Asegurese de haber seleccionado un archivo .PDF');
                archivoInput.value = '';
                return false;
            }
        }

        function calcular_monto_parcial(cant = 0,bandera=false)
        {   //console.log(event.target.value);
            var total = 1;
            var change= false; //
            
            var costo = parseFloat($("#costo").val());
            if (bandera && cant > 0) {
                //$("#descuento").each(function(){
                    if (!isNaN(parseFloat(cant))) 
                    { 
                        change= true;
                        total = parseFloat($("#costo_parcial").val()) + parseFloat(cant);
                    }
                //}); 
            } else {
                $(".calcular").each(function(){
                    if (!isNaN(parseFloat($(this).val()))) 
                    {
                        change= true;
                        total *= parseFloat($(this).val());
                    }
                });
            }
           
            // Si se modifico el valor , retornamos la multiplicación
            // caso contrario 0
            total = (change)? total:0;
            $("#costo_parcial").val(total);
           // document.getElementById('costo_parcial').innerHTML = total.toFixed(2);
        }

        $('#form').on('submit', function(e) {
            $('.loader').css('display', 'block')
            document.getElementById("btn_guardar").disabled = true;
        });

    </script>
@endpush






