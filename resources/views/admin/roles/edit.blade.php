@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar un rol</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::model($role, ['route'=>['admin.roles.update', $role], 'method'=>'put']) !!}
                @include('admin.roles.partials.form')

            {!! Form::submit('Editar rol', ['class'=>'btn btn-primary']) !!}
            <a class="btn btn-danger ml-3" href="{{route('admin.roles.index')}}">Cancelar</a>
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
