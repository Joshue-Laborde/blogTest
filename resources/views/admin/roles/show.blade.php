@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mostrar rol</h1>
@stop

@section('content')
    {{-- <p>{{$user=auth()->user()->roles}}</p> --}}
    <p>{{$roles}}</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
