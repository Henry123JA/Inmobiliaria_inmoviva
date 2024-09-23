<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario {{ $formulario->nombre }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Detalle del Formulario</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $formulario->nombre }}</h5>
                <p class="card-text"><strong>Correo:</strong> {{ $formulario->correo }}</p>
                <p class="card-text"><strong>Teléfono:</strong> {{ $formulario->telefono }}</p>
                <p class="card-text"><strong>Mensaje:</strong> {{ $formulario->mensaje }}</p>
                <a href="{{ route('formulario.index') }}" class="btn btn-primary">Volver a la lista</a>
            </div>
        </div>
    </div>
</body>
</html>
