@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Editar categoría</h1>
@stop

@section('content')

    {{-- @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif --}}

    <div class="card">
        <div class="card-body">
            {{-- Laravel collective: sirve para los formularios --}}
            {!! Form::model($category, ['route' => ['admin.categories.update', $category], 'method'=> 'put']) !!}

            <div class="form-group">

                {!! Form::label('name', 'Nombre') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la categoria']) !!}

                @error('name')
                    <span class="text-danger">{{ $message }} </span>
                @enderror

            </div>

            <div class="form-group">
                {!! Form::label('slug', 'Slug') !!}
                {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el slug de la categoria', 'readonly']) !!}

                @error('slug')
                    <span class="text-danger">{{ $message }} </span>
                @enderror

            </div>

            <div class="mt-4">
                {!! Form::submit('Actualizar categoria', ['class' => 'btn btn-primary']) !!}
                <a class="btn btn-danger ml-3" href="{{route('admin.categories.index')}}">Cancelar</a>

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
