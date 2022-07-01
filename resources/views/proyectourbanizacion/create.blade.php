@extends('layouts.app')
@section('title','Crear Proyectos Urbanización')
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
<form id="form" action="{{route('proyectourbanizacion.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card" style="background-color: #8FBC8F">
				<div class="card-header">
                    <i class="fas fa-pencil-alt"></i>
				    Crear nuevo proyecto.
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
                                <small>Arquitectos.</small> <i class="fa fa-exclamation-circle" aria-hidden="true" style="color: red;" title="Campo requerido"></i>
                            </div>
                        </div>
                        <!-- input axiliar -->
                        <input type="hidden" id="persona_id_input" name="persona_id_input" class="form-control">
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly class="form-control form-control-sm" required id="numeroregistro" placeholder="Nro. de Registro" autocomplete="off">
                                </div>
                                <small>Número de Registro.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <select required id="categoriaurbanizacion_id" class="form-control form-control-sm select2">
                                        <option selected disabled value="">Seleccionar Categoría</option>
                                        @foreach ($categoriaurbanizacions as $categoriaurbanizacion)
                                          <option value="{{$categoriaurbanizacion->id}}_{{$categoriaurbanizacion->arancel}}_{{$categoriaurbanizacion->costo_pu}}_{{$categoriaurbanizacion->porcentaje_cab}}_{{$categoriaurbanizacion->visado_sus}}_{{$categoriaurbanizacion->visado_bs}}">DE: {{$categoriaurbanizacion->mt2_inicio}} - A: {{$categoriaurbanizacion->mt2_fin}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small>Categorias.</small> <i class="fa fa-exclamation-circle" aria-hidden="true" style="color: red;" title="Campo requerido"></i>
                            </div>
                        </div>
                        <!-- input axiliar -->
                        <input type="hidden" id="categoriageneral_id_input" name="categoriageneral_id_input" class="form-control">
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly id="arancel" name="arancel" class="form-control form-control-sm" required placeholder="ARANCEL." autocomplete="off">
                                </div>
                                <small>Arancel.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly id="costo_pu" name="costo_pu" class="form-control form-control-sm" required placeholder="COSTO P.U." autocomplete="off">
                                </div>
                                <small>Costo P.U.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly id="porcentaje_cab" name="porcentaje_cab" class="form-control form-control-sm" required placeholder="PORCENTAJE CADBENI." autocomplete="off">
                                </div>
                                <small>Porcentaje C.A.B.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly id="visado_sus" name="visado_sus" class="form-control form-control-sm" required placeholder="VISADO $US." autocomplete="off">
                                </div>
                                <small>Visado $US. precio a 6.86</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly id="visado_bs" name="visado_bs" class="form-control form-control-sm" required placeholder="VISADO Bs." autocomplete="off">
                                </div>
                                <small>Visado Bs.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" step="0.01" id="superficiemts2" name="superficiemts2" class="form-control form-control-sm" required placeholder="SUPERFICIE." onkeyup="validar_precio(this)">
                                </div>
                                <small>Superficie - M2.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" step="0.001" name="descuento" class="form-control form-control-sm" required placeholder="DESCUENTO." autocomplete="off">
                                </div>
                                <small>Descuento.</small>
                            </div>
                        </div>
                        <!-- === -->
                        @php
                            $f_registro = date("Y-m-d");
                        @endphp
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" class="form-control form-control-sm" name="fecharegistro" value="{{$f_registro}}">
                                </div>
                                <small>Fecha de Registro.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="estado" class="form-control form-control-sm">
                                        <option value="pendiente">Pendiente</option>
                                        <option value="finalizado">Finalizado</option>
                                    </select>
                                </div>
                                <small>Estado</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="proyecto" class="form-control form-control-sm" required placeholder="Nombre del Proyecto." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Nombre del Proyecto.</small>
                            </div>
                        </div>
                        <!-- === -->
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="propietario" class="form-control form-control-sm" required placeholder="Propietario (S)." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Propietario.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" id="archivoInput" name="archivo" required onchange="return validarArchivo()" autocomplete="off">
                                </div>
                                <small>Archivo Adjunto.</small>
                            </div>
                        </div>
                        <!-- === -->
                    </div>
				</div>
				<div class="card-footer">
                    @include('proyectourbanizacion.partials.actions')
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

        //Select filtro +
        $("#persona_id").change(mostrarValoresPersonas);
        function mostrarValoresPersonas()
        {
            datoPersona = document.getElementById('persona_id').value.split('_');
            $("#persona_id_input").val(datoPersona[0]);
            $("#numeroregistro").val(datoPersona[1]);
        }

        //Select filtro +
        $("#categoriaurbanizacion_id").change(mostrarValoresCategoriageneral);
        function mostrarValoresCategoriageneral()
        {
            datoCategoria = document.getElementById('categoriaurbanizacion_id').value.split('_');
            $("#categoriageneral_id_input").val(datoCategoria[0]);
            $("#arancel").val(datoCategoria[1]);
            $("#costo_pu").val(datoCategoria[2]);
            $("#porcentaje_cab").val(datoCategoria[3]);
            $("#visado_sus").val(datoCategoria[4]);
            $("#visado_bs").val(datoCategoria[5]);
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
        var formatterUSD = new Intl.NumberFormat('en-US');
        $("#superficiemts22").keypress(function(event) {
            //if ( event.which == 13 ) {
            //    event.preventDefault();
                console.log(event.currentTarget.value);
                costo_pu = parseFloat(event.currentTarget.value) * parseFloat($("#arancel").val());
               
                vi_dolar = $("#porcentaje_cab").val() * costo_pu;
                //console.log(formatterUSD.format(vi_dolar));
                $dolar = 6.86;
                // const options2 = { style: 'currency', currency: 'USD' };
                // const numberFormat2 = new Intl.NumberFormat('en-US', options2);

                $("#costo_pu").val(costo_pu);
                $("#visado_sus").val(formatterUSD.format((vi_dolar * $dolar)/100));
                $("#visado_bs").val(formatterUSD.format(vi_dolar));
            //}
        });

        function validar_precio(numero){
            const dolar = 6.86;
            costo_pu = parseFloat(numero.value) * parseFloat($("#arancel").val());
            vi_dolar =  parseFloat($("#porcentaje_cab").val()) * costo_pu;
            $("#costo_pu").val(costo_pu);
            $("#visado_sus").val(formatterUSD.format((vi_dolar * dolar)/100));
            $("#visado_bs").val(formatterUSD.format(vi_dolar));
        }
        $('#form').on('submit', function(e) {
            $('.loader').css('display', 'block')
            document.getElementById("btn_guardar").disabled = true;
            //e.preventDefault();
        });

    </script>
@endpush






