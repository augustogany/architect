@extends('layouts.app')
@section('title','Crear Persona')

@section('content')
<form action="{{route('personas.store')}}" method="POST">
    @csrf
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					Registrar Nueva Persona
				</div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
				<div class="card-body">
                    <div class="row">
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" required name="nombre" placeholder="Nombres." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Nombres.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" required name="apaterno" placeholder="Apellido Paterno." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Apellido Paterno.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" required name="amaterno" placeholder="Apellido Materno." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Apellido Materno.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control form-control-sm" required name="numeroregistro" placeholder="NUMERO DE REGISTRO." autocomplete="off">
                                </div>
                                <small>Número de Registro.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control form-control-sm" name="telefonodomicilio"placeholder="TELEFONO DOMICILIO." autocomplete="off">
                                </div>
                                <small>Teléfono Domicilio.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control form-control-sm" name="telefonooficina"placeholder="TELEFONO OFICINA." autocomplete="off">
                                </div>
                                <small>Teléfono Oficina.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control form-control-sm" name="telefonocelular" placeholder="TELEFONO CELULAR." autocomplete="off">
                                </div>
                                <small>Teléfono Celular.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="email" class="form-control form-control-sm" name="correo" placeholder="E-MAIL." autocomplete="off">
                                </div>
                                <small>Correo Electrónico.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" class="form-control form-control-sm" name="fecha_afiliacion" required>
                                </div>
                                <small>Fecha de afiliación</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="month" class="form-control form-control-sm" name="ultimo_pago" required>
                                </div>
                                <small>Último mes pagado</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea class="form-control form-control-sm" name="direccion" placeholder="Direccion." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" rows="3"></textarea>
                                </div>
                                <small>Dirección.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12" align="center">
                            <label for="">Datos de Inicio de Session</label>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" name="email" placeholder="ejemplo@cadbeni.com" autocomplete="off" value="{{ old('email') }}">
                                </div>
                                <small>Nombre de Usuario</small>
                            </div>
                        </div>
                        <!-- === -->
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control form-control-sm" name="password" placeholder="password" autocomplete="off">
                                </div>
                                <small>Password</small>
                            </div>
                        </div>
                        <!-- === -->
                    </div>
				</div>
				<div class="card-footer text-right">
                    <a href="{{route('personas.index')}}" class="btn btn-outline-dark"><i class="fas fa-times"></i> Cancelar</a>
                    <button type="submit" class="btn btn-outline-success"><i class="fas fa-save"></i> Guardar</button>
				</div>

			</div>
		</div>
	</div>
</div>
</form>
@endsection







