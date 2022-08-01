@extends('layouts.app')
@section('title','Crear Perfil Usuario')

@section('content')
<form id="form" action="{{route('perfilusuario.store')}}" method="POST">
@csrf

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Registrar Datos Adicionales del Usuario.
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- === -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input 
                                        type="text" 
                                        class="form-control form-control-sm" 
                                        required 
                                        name="nombre" 
                                        placeholder="Nombres" 
                                        style="text-transform:uppercase;" 
                                        onkeyup ="this.value=this.value.toUpperCase()" 
                                        autocomplete="off"
                                        value="{{$persona->nombre ?? ''}}"
                                    >
                                </div>
                                <small>Nombres.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input 
                                        type="text" 
                                        class="form-control form-control-sm" 
                                        required name="apaterno" 
                                        placeholder="Apellido Paterno" 
                                        style="text-transform:uppercase;" 
                                        onkeyup ="this.value=this.value.toUpperCase()" 
                                        autocomplete="off"
                                        value="{{$persona->apaterno ?? ''}}"
                                    >
                                </div>
                                <small>Apellido Paterno.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" 
                                           class="form-control form-control-sm" 
                                           required name="amaterno" 
                                           placeholder="Apellido Materno" 
                                           style="text-transform:uppercase;" 
                                           onkeyup ="this.value=this.value.toUpperCase()" 
                                           autocomplete="off"
                                           value="{{$persona->amaterno ?? ''}}"
                                        >
                                </div>
                                <small>Apellido Materno.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input 
                                    type="text" 
                                    class="form-control form-control-sm" 
                                    required name="ci" 
                                    placeholder="Nro. Carnet" 
                                    style="text-transform:uppercase;" 
                                    onkeyup ="this.value=this.value.toUpperCase()" 
                                    value="{{$persona->ci ?? ''}}"
                                >
                                </div>
                                <small>Carnet Identidad.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <?php 
                                     $expe_id = $persona->expedicion_id ?? 0;
                                    ?>
                                    <select required name="expedicion_id"  class="form-control form-control-sm">
                                        @foreach ($expedicions as $exp)
                                            <option 
                                                {{(int)old('expedicion_id') === $exp->id ||$expe_id === $exp->id ? 'selected' : ''}}
                                                value="{{$exp->id}}"
                                            >
                                            {{$exp->nombre}}
                                            </option>
                                        @endforeach
                                      </select>
                                </div>
                                <small>Expedición de Carnet.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input 
                                        type="number" 
                                        class="form-control form-control-sm" 
                                        required name="telefono" 
                                        placeholder="TELEFONO" 
                                        autocomplete="off"
                                        value="{{$persona->telefono ?? ''}}">
                                </div>
                                <small>Teléfono.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea
                                        class="form-control form-control-sm" 
                                        required name="direccion" 
                                        placeholder="Dirección" 
                                        style="text-transform:uppercase;" 
                                        onkeyup ="this.value=this.value.toUpperCase()" 
                                        rows="3"
                                    >
                                    {{$persona->direccion ?? ''}}
                                    </textarea>
                                </div>
                                <small>Direccion.</small>
                            </div>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12" align="center">
                            <label for="">Caambiar Password</label>
                        </div>
                        <!-- === -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control form-control-sm" name="password" placeholder="password." autocomplete="off">
                                </div>
                                <small>Se cambiara solo si ingresas una nueva.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    @include('perfilusuario.partials.actions')
                </div>
            </div>
        </div>
    </div>
</div>

</form>
@endsection