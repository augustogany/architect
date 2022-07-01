@extends('layouts.app')
@section('title','Editar Persona')

@section('content')
<form action="{{route('categoriageneral.update',$categoriageneral->id)}}" method="POST">
    @csrf @method('PATCH')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					Editar Categoría General: <strong>{{$categoriageneral->nombre}}</strong>
				</div>

				<div class="card-body">
                    <div class="row">
                        <!-- === -->
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-control-sm" name="nombre" value="{{$categoriageneral->nombre}}" required placeholder="Nombres." style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()" autocomplete="off">
                                </div>
                                <small>Nombres.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" step="0.01" class="form-control form-control-sm" name="costo" value="{{$categoriageneral->costo}}" required placeholder="COSTO." autocomplete="off">
                                </div>
                                <small>Costo.</small>
                            </div>
                        </div>
                        <!-- === -->
                    </div>
				</div>
				<div class="card-footer">
                    @include('categoriageneral.partials.actions')
				</div>

			</div>
		</div>
	</div>
</div>
</form>
@endsection







