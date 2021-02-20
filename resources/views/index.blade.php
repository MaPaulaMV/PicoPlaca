@extends('layouts.master')
@section('title', 'Pico&Placa Predictor')
@section('parentPageTitle', 'Code Exercise')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/light-gallery/css/lightgallery.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fullcalendar/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}"/>
@stop
@section('content')
<div class="row clearfix">
    <div class="card">
        <div class="body">
            <form id="form-predictor" method="POST">
                @csrf
                <h2 class="card-inside-title"><strong>Ingreso de Datos</strong></h2>
                <div class="row clearfix">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="number" name="number" maxlength="7"
                                   placeholder="N° Placa" onkeypress="return check(event)" required/>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                            </div>
                            <input type="text" class="form-control datetimepicker" id="date-time" name="date-time"
                                   placeholder="Fecha y Hora">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary waves-effect" id="predict" name="user-save">
                            <i class="zmdi ti-check"></i> Verificar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('page-script')
    <script src="{{asset('assets/bundles/c3.bundle.js')}}"></script>
    <script src="{{asset('assets/plugins/summernote/dist/summernote.js')}}"></script>
    <script src="{{asset('assets/js/pages/ticket-page.js')}}"></script>
    <script src="{{asset('assets/plugins/momentjs/moment.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/basic-form-elements.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10.14.1/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('#predict').on('click', function (e) {
                e.preventDefault();
                var formData = {
                    plateNumber: $('input[name^="number"]').val(),
                    dateTime: $('input[name^="date-time"]').val(),
                };

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('predict')}}",
                    type: "POST",
                    data: formData,
                    dataType: 'JSON',
                    beforeSend: function () {
                        Swal.fire({
                            title: "Verificando...",
                            text: "Verificando número de placa, fecha y hora",
                            icon: "info",
                            buttons: false,
                            showConfirmButton: false
                        });
                    },
                    success: function (data) {
                        Swal.close();
                        if (data.status === 'success') {
                            Swal.fire({
                                title: data.title,
                                text: data.message,
                                icon: data.status,
                                confirmButtonClass: 'btn-success',
                                confirmButtonText: 'Aceptar'
                            });
                            $('input[name^="number"]').val("");
                            $('input[name^="date-time"]').val("");

                        }else if(data.status === 'warning'){
                            Swal.fire({
                                title: data.title,
                                text: data.message,
                                icon: "warning",
                                showCancelButton: false,
                                confirmButtonText: 'Cerrar'
                            });
                            $('input[name^="number"]').val("");
                            $('input[name^="date-time"]').val("");

                        } else {
                            Swal.fire({
                                title: data.title,
                                text: data.message,
                                icon: "error",
                                showCancelButton: false,
                                confirmButtonText: 'Cerrar'
                            });
                        }
                    }
                });
            });

        });

        /**
         * Only Letters and numbers
         *
         * @param e
         * @returns {boolean}
         */
        function check(e) {
            key = (document.all) ? e.keyCode : e.which;

            if (key == 8) {
                return true;
            }

            patron = /[A-Za-z0-9]/;
            key_final = String.fromCharCode(key);
            return patron.test(key_final );
        }
    </script>
@stop
