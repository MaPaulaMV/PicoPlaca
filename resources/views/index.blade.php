@extends('layouts.master')
@section('title', 'Pico&Placa Predictor')
@section('parentPageTitle', 'Code Exercise')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/light-gallery/css/lightgallery.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fullcalendar/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}"/>
@stop
@section('content')
<div class="row clearfix">
    <div class="card">
        <div class="body">
            <form id="form-predictor" method="POST">
                @csrf

            </form>
        </div>
    </div>
</div>
@endsection

