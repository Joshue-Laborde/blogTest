@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Lista de roles</h1>
@stop

@section('content')
<div class="card">

    <div class="card-header">
        <a class="btn btn-success" href="{{ route('admin.roles.create') }}">Nuevo rol</a>
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th colspan="2"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td width="10px">
                            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-primary">Editar</a>
                            {{-- <a href="{{ route('admin.roles.show', $role) }}" class="btn btn-sm btn-primary">Practica</a> --}}
                        </td>
                        <td width="10px">
                            {!! Form::open(['route' => ['admin.roles.destroy', $role], 'method' => 'delete', 'onsubmit' => 'return confirm("Esta seguro de borrar el rol?")']) !!}
                                {!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
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

    $(function() {

        @if (Session('info2'))
            Swal.fire({
            icon: 'success',
            title: 'Deleted!',
            text: '{{ Session::get('info2') }}'
            })
        @endif
    });
</script>

@stop
