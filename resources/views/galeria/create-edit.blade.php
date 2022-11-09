@extends('layouts.app')
@section('title', $tipo == 'create' ? 'Registrar nueva imagen' : 'Editar imagen')

@section('content')
<form action="{{ $tipo == 'create' ? route('galerias.store') : route('galerias.update', $imagen->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($tipo == 'edit')
        @method('put')
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if ($tipo == 'create')
                            <i class="fas fa-pencil-alt"></i>
                            Registrar nueva imagen
                        @else
                            <i class="fas fa-edit"></i>
                            Editar imagen
                        @endif
                        
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
                                        <select name="tipo" id="select-tipo" class="form-control form-control-sm" required>
                                            <option value="Construcciones civiles">Construcciones civiles</option>
                                        </select>
                                    </div>
                                    <small>Sucursal</small>
                                </div>
                            </div>
                            <!-- === -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="titulo" min="1" step="1" value="{{ isset($imagen) ? $imagen->titulo : '' }}" class="form-control form-control-sm" required>
                                    </div>
                                    <small>Título</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea name="detalles" class="form-control form-control-sm" rows="3">{{ isset($imagen) ? $imagen->detalles : '' }}</textarea>
                                    </div>
                                    <small>Detalles</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" name="archivo" accept="image/*" class="form-control form-control-sm">
                                    </div>
                                    <small>Archivo</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success"><i class="fas fa-save"></i> {{ $tipo == 'create' ? 'Guardar' : 'Actualizar'}}</button>
                        <a href="{{ route('galerias.index') }}" class="btn btn-outline-success"><i class="fas fa-history"></i> Volver a la Lista</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push ('script')
    <script>
        $(document).ready(function(){
            @isset($imagen)
                $('#select-tipo').val('{{ $imagen->tipo }}')
            @endisset
        });
    </script>
@endpush