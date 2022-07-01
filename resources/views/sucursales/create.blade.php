@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Registrar Sucursal del Sistema</h3>
				</div>

			<form action="{{route('sucursales.store')}}" method="POST">
				@csrf
				<div class="card-body">
					@if(count($errors)>0)
                    <div class="alert alert-danger">
                      <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                      </ul>
                    </div>
                    @endif
                    <div class="row">
                    	<!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" required name="sucursal" value="{{old('sucursal')}}" placeholder="Sucursal" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
                                </div>
                                <small>Sucursal.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" required name="ubicacion" value="{{old('ubicacion')}}" placeholder="Ubicación sucursal" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
                                </div>
                                <small>Ubicación de Sucursal.</small>
                            </div>
                        </div>
                        <!-- === -->
					</div>
				</div>

				<div class="card-footer">
					@include('sucursales.partials.actions')
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
@endsection