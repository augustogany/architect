@extends('layouts.app')
@section('title','Editar Proyectos')
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
<form id="form" action="{{route('proyectourbanizacion.update',$proyectourbanizacion->id)}}" method="POST" enctype="multipart/form-data">
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
                                        <option value="{{$persona->id}}" {{(collect($proyectourbanizacion->persona_id)->contains($persona->id)) ? 'selected':''}}>{{$persona->nombre}} {{$persona->apaterno}} {{$persona->amaterno}} :: Código de registro: {{$persona->numeroregistro}} ::</option>
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
                                    <select required id="categoriaurbanizacion_id" class="form-control form-control-sm select2">
                                        <option selected disabled value="">Seleccionar Categoría</option>
                                        @foreach ($categoriaurbanizacions as $categoriaurbanizacion)
                                          <option value="{{$categoriaurbanizacion->id}}_{{$categoriaurbanizacion->arancel}}_{{$categoriaurbanizacion->costo_pu}}_{{$categoriaurbanizacion->porcentaje_cab}}_{{$categoriaurbanizacion->visado_sus}}_{{$categoriaurbanizacion->visado_bs}}" {{(collect($proyectourbanizacion->categoriaurbanizacion_id)->contains($categoriaurbanizacion->id)) ? 'selected':''}}>DE: {{$categoriaurbanizacion->mt2_inicio}} - A: {{$categoriaurbanizacion->mt2_fin}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small>Categorias.</small>
                            </div>
                        </div>
                        <!-- input axiliar -->
                        <input type="hidden" id="categoriaurbanizacion_id_input" name="categoriaurbanizacion_id_input" class="form-control">
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly id="arancel" name="arancel" value="{{$proyectourbanizacion->arancelcategoria}}" class="form-control form-control-sm" required placeholder="Arancel" autocomplete="off">
                                </div>
                                <small>Arancel.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly id="costo_pu" name="costo_pu" value="{{$proyectourbanizacion->costo_pu_categoria}}" class="form-control form-control-sm" required placeholder="Costo P.U." autocomplete="off">
                                </div>
                                <small>Costo P.U.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly id="porcentaje_cab" name="porcentaje_cab" value="{{$proyectourbanizacion->porcentaje_cab_categoria}}" class="form-control form-control-sm" required placeholder="Porcentaje C.A.B." autocomplete="off">
                                </div>
                                <small>Porcentaje C.A.B.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly id="visado_sus" name="visado_sus" value="{{$proyectourbanizacion->visado_sus_categoria}}" class="form-control form-control-sm" required placeholder="Visado Bs." autocomplete="off">
                                </div>
                                <small>Visado Bs.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly id="visado_bs" name="visado_bs" value="{{$proyectourbanizacion->visado_bs_categoria}}" class="form-control form-control-sm" required placeholder="Visado Bs." autocomplete="off">
                                </div>
                                <small>Visado Bs.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" step="0.01" name="superficiemts2" value="{{$proyectourbanizacion->superficiemts2}}" class="form-control form-control-sm" required placeholder="Superficie" autocomplete="off">
                                </div>
                                <small>Superficie - M2.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" step="0.001" name="descuento" value="{{$proyectourbanizacion->descuento}}" class="form-control form-control-sm" required placeholder="DESCUENTO." autocomplete="off">
                                </div>
                                <small>Descuento.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" class="form-control form-control-sm" name="fecharegistro" value="{{$proyectourbanizacion->fecharegistro}}">
                                </div>
                                <small>Fecha de Registro.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="estado" class="form-control form-control-sm">
                                        <option 
                                               value="pendiente" 
                                               {{$proyectourbanizacion->estado == 'pendiente' ? 'selected' : ''}}
                                        >
                                            Pendiente
                                        </option>
                                        <option 
                                                value="finalizado"
                                                {{$proyectourbanizacion->estado == 'finalizado' ? 'selected' : ''}}
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
                                    <input type="text" name="proyecto" value="{{$proyectourbanizacion->proyecto}}" class="form-control form-control-sm" required placeholder="Nombre del Proyecto." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Nombre del Proyecto.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="propietario" value="{{$proyectourbanizacion->propietario}}" class="form-control form-control-sm" required placeholder="Propietario." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
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
                    @include('proyectourbanizacion.partials.actions_update')
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
        $("#categoriaurbanizacion_id").change(mostrarValoresCategoriageneral);
        function mostrarValoresCategoriageneral()
        {
            datoCategoria = document.getElementById('categoriaurbanizacion_id').value.split('_');
            $("#categoriaurbanizacion_id_input").val(datoCategoria[0]);
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

        $('#form').on('submit', function(e) {
            $('.loader').css('display', 'block')
        });

    </script>
@endpush






