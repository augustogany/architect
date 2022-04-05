@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Registrar Asignación de Sucursal</h3>
				</div>

			<form action="{{route('sucursales_usuarios.store')}}" method="POST">
				@csrf
				<div class="card-body">
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
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <select required name="sucursal_id" class="form-control form-control-sm select2">
				                    	@foreach ($sucursales as $sucursal)
					                  		<option value="{{$sucursal->id}}">{{$sucursal->sucursal}}</option>
					                	@endforeach
				                  	</select>
                                </div>
                                <small>Sucursales.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <select required name="user_id" class="form-control form-control-sm select2">
				                    	@foreach ($users as $usuer)
					                  		<option value="{{$usuer->id}}">{{$usuer->name}}</option>
					                	@endforeach
				                  	</select>
                                </div>
                                <small>Usuario del Sistema.</small>
                            </div>
                        </div>
                        <!-- === -->
                    </div>
				</div>
				<div class="card-footer">
					@include('sucursal_usuario.partials.actions')
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
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
    </script>
@endpush






