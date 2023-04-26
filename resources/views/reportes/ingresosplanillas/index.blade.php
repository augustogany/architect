@extends('layouts.app')
@section('title','Proyectos: Viviendas - Comercio y Oficinas')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-th-list"></i>
                        Reporte de Ingresos por fecha y mensual
                        <div class="card-tools">
                        
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <form id="form" name="form" action="{{ route('exportPlanillaExcel') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="type">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input type="date" id="inicio" name="inicio" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="date" id="fin" name="fin" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12 text-right">
                                            <button class="btn btn-sm btn-primary">Descargar</button>
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
                        <strong>Copyright &copy; 2023 <a href="#">CADBENI</a>.</strong> Todos los derechos reservados.
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
            const today = new Date().toISOString().substr(0, 10);
            document.querySelector("#inicio").value = today;
            document.querySelector("#fin").value = today;
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


