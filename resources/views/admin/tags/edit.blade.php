@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Editar etiqueta</h1>
@stop

@section('content')

   {{--  @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif --}}

    <div class="card">
        <div class="card-body">
            {!! Form::model($tag, ['route' => ['admin.tags.update', $tag], 'method' => 'put']) !!}
                @include('admin.tags.partials.form')


            <div class="mt-4">
                {!! Form::submit('Editar etiqueta', ['class' => 'btn btn-primary']) !!}
                <a class="btn btn-danger ml-3" href="{{route('admin.tags.index')}}">Cancelar</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"> </script>

    <script>
        $(document).ready(function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });
    </script>
@stop
