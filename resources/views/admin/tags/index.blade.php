@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')

{{-- <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.tags.create') }}">Nueva etiqueta</a> --}}
    <h1>Mostrar listado de etiqueta</h1>
@stop

@section('content')

  {{--   @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif --}}

    <div class="card">
        @can('admin.tags.create')
            <div class="card-header">
                <a class="btn btn-success" href="{{ route('admin.tags.create') }}">Nueva etiqueta</a>
            </div>
        @endcan
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)

                        <tr>
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->name }}</td>
                            <td width=10px>
                                @can('admin.tags.edit')
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.tags.edit', $tag) }}">Editar</a>
                                @endcan
                            </td>
                            <td width=10px>
                                @can('admin.tags.destroy')
                                    {{-- <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST">

                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>

                                    </form> --}}

                                    {!! Form::open(['route' => ['admin.tags.destroy', $tag], 'method' => 'delete', 'onsubmit' => 'return confirm("Esta seguro de borrar la etiqueta?")']) !!}
                                     {!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>

                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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

    <script>
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
