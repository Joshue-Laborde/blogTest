@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
<a class="btn btn-secondary float-right" href="{{ route('admin.posts.create') }}">Nueva categoria</a>

    <h1>Listado de posts</h1>
@stop

@section('content')
    @livewire('admin.posts-index')
@stop



@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
