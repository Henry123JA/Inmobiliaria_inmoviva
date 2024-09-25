<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Formulario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Formulario</h1>

        <form action="{{ route('formulario.update', $formulario->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $formulario->nombre) }}">
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo', $formulario->correo) }}">
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $formulario->telefono) }}">
            </div>

            <div class="mb-3">
                <label for="mensaje" class="form-label">Preferencia</label>
                <input type="text" class="form-control" id="mensaje" name="mensaje" value="{{ old('mensaje', $formulario->mensaje) }}">
            </div>

            <div class="mb-3">
                <label for="tipo_de_propiedad">Selecciona el Tipo de Propiedad</label>
                <select name="tipo_de_propiedad_id" id="tipo_de_propiedad" class="form-select">
                    @foreach($tiposDePropiedad as $tipo)
                        <option value="{{ $tipo->id }}" {{ $tipo->id == $formulario->tipo_de_propiedad_id ? 'selected' : '' }}>
                            {{ $tipo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
