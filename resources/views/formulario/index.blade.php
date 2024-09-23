<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Formularios</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('formulario.create') }}" class="btn btn-primary mb-3">Crear Formulario
        </a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Mensaje</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($formularios as $formulario)
                    <tr>
                        <td>{{ $formulario->id }}</td>
                        <td>{{ $formulario->nombre }}</td>
                        <td>{{ $formulario->correo }}</td>
                        <td>{{ $formulario->telefono }}</td>
                        <td>{{ $formulario->mensaje }}</td>
                        <td>
                            <a href="{{ route('formulario.show', $formulario->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('formulario.edit', $formulario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('formulario.destroy', $formulario->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>