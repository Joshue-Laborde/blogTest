@extends('adminlte::page')
@section('title', 'Blog')

@section('content_header')
    <h1>Lista de categorias</h1>
@stop

@section('content')

    {{-- bootstrap --}}
    <div class="card">

        @can('admin.categories.create')
            <div class="card-header">
                <a class="btn btn-success" href="{{ route('admin.categories.create') }}">Nueva categoria</a>
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
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td width=10px>
                                @can('admin.categories.edit')
                                    <a class="btn btn-primary btn-sm"
                                    href="{{ route('admin.categories.edit', $category) }}">Editar</a>
                                @endcan
                            </td>
                            <td width=10px>
                                @can('admin.categories.destroy')
                                    {{-- form action="{{ route('admin.categories.destroy', $category) }}"
                                    method="POST">
                                        @csrf
                                        @method('delete')

                                        <button type="submit"
                                            class="btn btn-danger btn-sm show_confirm">Eliminar</button>
                                </form> --}}

                                {!! Form::open(['route' => ['admin.categories.destroy', $category], 'method' => 'delete', 'onsubmit' => 'return confirm("Esta seguro de borrar la categoria?")']) !!}
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

        /* $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      }); */
    </script>
@stop
