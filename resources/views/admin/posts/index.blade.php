@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <a class="btn btn-secondary float-right" href="{{ route('admin.posts.create') }}">Nuevo Post</a>

    <h1>Listado de posts</h1>
@stop

@section('content')
    @livewire('admin.posts-index')
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
