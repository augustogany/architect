@extends('layouts.app')
@section('title','Editar Arancel Urbanización')

@section('content')
<form action="{{route('categoriaurbanizacion.update',$categoriaurbanizacion->id)}}" method="POST">
    @csrf @method('PATCH')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					Editar Categoría Urbanización: <strong>DE: {{$categoriaurbanizacion->mt2_inicio}} - A: {{$categoriaurbanizacion->mt2_fin}}</strong>
				</div>

				<div class="card-body">
                    <div class="row">
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" name="mt2_inicio" value="{{$categoriaurbanizacion->mt2_inicio}}" required placeholder="Nombres."autocomplete="off">
                                </div>
                                <small>DE.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" name="mt2_fin" value="{{$categoriaurbanizacion->mt2_fin}}" required placeholder="Nombres."autocomplete="off">
                                </div>
                                <small>A.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" step="0.01" class="form-control form-control-sm" name="arancel" value="{{$categoriaurbanizacion->arancel}}" required placeholder="Nombres." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Arancel.</small>
                            </div>
                        </div>
                        <!-- === -->
                        {{-- <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" step="0.01" class="form-control form-control-sm" name="costo_pu" value="{{$categoriaurbanizacion->costo_pu}}" required placeholder="COSTO." autocomplete="off">
                                </div>
                                <small>Costo P.U.</small>
                            </div>
                        </div> --}}
                        <!-- === -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" step="0.01" class="form-control form-control-sm" name="porcentaje_cab" value="{{$categoriaurbanizacion->porcentaje_cab}}" required placeholder="COSTO." autocomplete="off">
                                </div>
                                <small>Porcentaj C.A.B.</small>
                            </div>
                        </div>
                        <!-- === -->
                        {{-- <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" step="0.01" class="form-control form-control-sm" name="visado_sus" value="{{$categoriaurbanizacion->visado_sus}}" required placeholder="COSTO." autocomplete="off">
                                </div>
                                <small>Visado $US.</small>
                            </div>
                        </div> --}}
                        <!-- === -->
                        {{-- <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" step="0.01" class="form-control form-control-sm" name="visado_bs" value="{{$categoriaurbanizacion->visado_bs}}" required placeholder="COSTO." autocomplete="off">
                                </div>
                                <small>Visado Bs.</small>
                            </div>
                        </div> --}}
                        <!-- === -->
                    </div>
				</div>
				<div class="card-footer">
                    @include('categoriaurbanizacion.partials.actions')
				</div>

			</div>
		</div>
	</div>
</div>
</form>
@endsection







