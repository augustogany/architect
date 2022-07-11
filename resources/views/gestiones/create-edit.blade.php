@extends('layouts.app')
@section('title', $type == 'create' ? 'Registrar nueva gestión' : 'Editar gestión')

@section('content')
<form action="{{ $type == 'create' ? route('gestiones.store') : route('gestiones.update', $gestion->id) }}" method="POST">
    @csrf
    @if ($type == 'edit')
        @method('put')
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if ($type == 'create')
                            Registrar nueva gestión
                        @else
                            Editar gestión
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
                                        <select name="sucursal_id" id="select-sucursal_id" class="form-control form-control-sm" required>
                                            <option value="">Seleccione la sucursal</option>
                                            @foreach (App\Sucursal::get() as $item)
                                                <option value="{{ $item->id }}">{{ $item->sucursal }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small>Sucursal</small>
                                </div>
                            </div>
                            <!-- === -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" name="gestion" min="2000" step="1" placeholder="{{ date('Y') }}" value="{{ isset($gestion) ? $gestion->gestion : date('Y') }}" class="form-control form-control-sm" required>
                                    </div>
                                    <small>Gestión</small>
                                </div>
                            </div>
                            <!-- === -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" name="mensualidad" min="1" step="1" value="{{ isset($gestion) ? $gestion->mensualidad : '' }}" class="form-control form-control-sm" required>
                                    </div>
                                    <small>Mensualidad</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea name="observaciones" class="form-control form-control-sm" rows="3">{{ isset($gestion) ? $gestion->observaciones : '' }}</textarea>
                                    </div>
                                    <small>Observaciones</small>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success"><i class="fas fa-save"></i> {{ $type == 'create' ? 'Guardar' : 'Actualizar'}}</button>
                        <a href="{{route('gestiones.index')}}" class="btn btn-outline-success"><i class="fas fa-history"></i> Volver a la Lista</a>
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
            @isset($gestion)
                $('#select-sucursal_id').val('{{ $gestion->sucursal_id }}')
            @endisset
        });
    </script>
@endpush