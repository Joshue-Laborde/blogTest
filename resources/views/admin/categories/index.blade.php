@extends('adminlte::page')
@section('title', 'Blog')

@section('content_header')
    <h1>Lista de categorias</h1>
@stop

@section('content')

    {{-- bootstrap --}}
    <div class="card">

        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('admin.categories.create') }}">Agregar categoria</a>
        </div>

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
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td width=10px>
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('admin.categories.edit', $category) }}">Editar</a>
                            </td>
                            <td width=10px>
                                <form action="{{ route('admin.categories.destroy', $category) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')

                                    <button type="submit"
                                        class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

{{-- @section('css')

@stop --}}

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
