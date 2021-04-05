<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('fonts/awesome/font-awesome.min.css')}}">
    {{-- DataPicker --}}
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-standalone.css')}}">
    <!-- Fonts -->
        <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- Scripts --}}
    <script src="js/1.3.7.tether.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    {{-- Datatables --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script> --}}
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap.min.js"></script>
    {{-- Datatables fin --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
        <!-- Languaje datapicker -->
    <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/stlf.js') }}" ></script>








