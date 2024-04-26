<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <header class="bg-danger py-3 text-center">
                    <h1 class="mb-0 text-white">{{ $category->Category_name }}</h1>
                </header>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-9 col-lg-6">
                <table class="table mb-4">
                    <tbody>
                        <tr>
                            <td><b>Created at:</b> {{ $category->created_at->diffForHumans() }}</td>
                            <td><b>Updated at:</b> {{ $category->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>

                <p style="white-space: pre-wrap;">{{ $category->content }}</p>

                <div class="text-end">
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Editar Categoría</a>

                    <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                        @csrf
                        @method('delete')

                        <input type="submit" value="Eliminar Nota" class="btn btn-danger" onclick="return confirm('¿Estás seguro que quieres eliminarla?')">
                    </form>
                </div>
                <h2>Notas en esta categoría</h2>

                @if (count($notes) > 0)
                    <ul class="list-group">
                        @foreach ($notes as $note)
                            <li class="list-group-item">
                                <a href="{{ route('notes.show', $note->id) }}">{{ $note->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No hay notas asociadas a esta categoría.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>