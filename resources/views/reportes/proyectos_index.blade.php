@extends('layouts.app')
@section('title','Proyectos: Viviendas - Comercio y Oficinas')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-th-list"></i>
                        Proyectos: Viviendas - Comercio y Oficinas
                        <div class="card-tools">
                        
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <form id="form" name="form" action="{{ route('reportes.proyectos.list') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="type">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input type="date" name="inicio" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="date" name="fin" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select name="tipo" class="form-control form-control-sm" required>
                                                <option value="general">Generales</option>
                                                <option value="urbanizacion">Urbanización</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select name="persona_id" class="form-control form-control-sm select2">
                                                <option value="">Todos los afiliados</option>
                                                @foreach (App\Persona::orderBy('nombre')->get() as $item)
                                                <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 text-right">
                                            <button class="btn btn-sm btn-primary">Generar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <div id="lista"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right d-none d-sm-block">
                            <b>Version</b> 1.2
                        </div>
                        <strong>Copyright &copy; 2022 <a href="#">CADBENI</a>.</strong> Todos los derechos reservados.
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push ('styles')
    <link rel="stylesheet" href="{{asset('theme/plugins/select2/css/select2.min.css')}}">
@endpush

@push ('script')
    <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('#form').submit(function(e){
                e.preventDefault();
                $.post($(this).attr('action'), $(this).serialize(), function(res){
                    $('#lista').html(res);
                });
            });
        });

        function report_export(type){
            $('#form').attr('target', '_blank');
            $('#form input[name="type"]').val(type);
            window.form.submit();
            $('#form').removeAttr('target');
            $('#form input[name="type"]').val('');
        }
    </script>
@endpush


