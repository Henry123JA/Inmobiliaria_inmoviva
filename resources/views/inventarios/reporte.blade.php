<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Inventario - Inmoviva</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header, .footer {
            background-color: #4A90E2;
            color: white;
            padding: 15px 0;
            text-align: center;
        }
        .container {
            padding: 30px;
            margin: 20px auto;
            border-radius: 8px;
            max-width: 800px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            color: #333;
        }
        img {
            width: 150px; /* Ajuste del tamaño de la imagen */
        }
        @media print {
            .container {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Reporte del Inventario</h1>
            <p><strong>Fecha y Hora:</strong> {{ $currentDateTime }}</p>
            <p><strong>Usuario:</strong> {{ $user->name }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Propiedad</th>
                    <th>Tipo de Propiedad</th>
                    <th>Fecha</th>
                    <th>Dirección</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datosInventario as $inventario)
                <tr>
                    <td>{{ $inventario['id'] }}</td>
                    <td>{{ $inventario['propiedad'] }}</td>
                    <td>{{ $inventario['tipo_propiedad'] }}</td>
                    <td>{{ $inventario['fecha'] }}</td>
                    <td>{{ $inventario['direccion'] }}</td>
                    <td><img src="{{ public_path($inventario['imagen']) }}" alt="Imagen"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>&copy; 2024 Inmoviva. Todos los derechos reservados.</p>
    </div>
</body>

</html>
