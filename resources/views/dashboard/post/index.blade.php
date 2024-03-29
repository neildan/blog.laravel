@extends('dashboard.master')

@section('content')
<h1>Post</h1>

<a class="btn btn-primary mb-2" href="{{ route('post.create') }}">
    Crear nuevo post
</a>

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Titulo</th>
            <th>Categoría</th>
            <th>Url Limpia</th>
            <th>Posted</th>
            <th>Creado</th>
            <th>Actualizado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>
                {{ $post->id }}
            </td>
            <td>
                {{ $post->title }}
            </td>
            <td>
                @empty($post->category)
                    No hay
                @else
                    {{ $post->category->title }}
                @endempty
            </td>
            <td>
                {{ $post->url_clean }}
            </td>
            <td>
                {{ ($post->posted == 'yes') ? 'Si' : 'No' }}
            </td>
            <td>
                {{ $post->created_at->format('d-M-Y') }}
            </td>
            <td>
                {{ $post->updated_at->format('d-M-Y') }}
            </td>
            <td>
                <a href="{{ route('post.show', $post->id) }}" class="btn btn-sm btn-success">Ver</a>

                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-primary">Actualizar</a>

                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#borrarPost" data-id="{{ $post->id }}">Borrar</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $posts->links() }}

<div class="modal fade" id="borrarPost" tabindex="-1" role="dialog" aria-labelledby="borrarPostLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="borrarPostLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Seguro que quiere eliminar este post?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <form id="form-delete" action="{{ route('post.destroy', 0) }}" data-action="{{ route('post.destroy', 0) }}" method="POST">
                    @method('DELETE')
                    @csrf

                    <button type="submit" class="btn btn-danger">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        $('#borrarPost').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-title').text('Eliminar post: ' + id)

            var action = $('#form-delete').attr('data-action').slice(0, -1)
            action += id
            $('#form-delete').attr('action', action)
        })
    }
</script>
@endsection