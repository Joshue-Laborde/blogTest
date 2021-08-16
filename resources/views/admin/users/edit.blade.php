@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
<h1>Asignar un rol</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <p class="h5">Nombre</p>
        <p class="form-control">{{ $user->name }}</p>

        <h2 class="h5">Listado de roles</h2>
        {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}
        @foreach ($roles as $role)
            <div>
                <label>
                    {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                    {{ $role->name }}
                </label>
            </div>

        @endforeach

        {!! Form::submit('Asignar rol', ['class' => 'btn btn-primary mt-2']) !!}
        <a class="btn btn-danger ml-3" href="{{route('admin.users.index')}}">Cancelar</a>

        {!! Form::close() !!}
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop