@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Lista de usuarios</h1>
@stop

@section('content')
    @livewire('admin.users-index')
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function() {

        @if (Session('info'))
            Swal.fire({
            icon: 'success',
            title: 'Good job!',
            text: '{{ Session::get('info') }}'
            })
        @endif
    });
</script>
@stop
