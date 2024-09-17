<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura - Jenecheru</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
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
            background-color: white;
            padding: 30px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
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
        .total-row {
            font-weight: bold;
            background-color: #f4f4f4;
        }
        .btn-print {
            background-color: #4A90E2;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        .btn-print:hover {
            background-color: #357ABD;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #4A90E2;
            padding-bottom: 10px;
        }
        .invoice-header .company-details {
            text-align: left;
        }
        .invoice-header .invoice-title {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            margin: 0;
        }
        .invoice-header .invoice-meta {
            text-align: right;
        }
        .company-details p, .invoice-meta p {
            margin: 0;
            line-height: 1.5;
        }
        @media print {
            .btn-print {
                display: none;
            }
            .container {
                box-shadow: none;
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Jenecheru</h1>
    </div>
    <div class="container mx-auto py-10">
        <div class="invoice-header">
            <div class="company-details">
                <p><strong>Jenecheru</strong></p>
                <p>Dirección de la Empresa: Radial 17 - calle Jenecheru</p>
                <p>Teléfono: +123 456 789</p>
                <p>Email: info@jenecheru.com</p>
            </div>
            <div class="invoice-title">
                <h1>FACTURA</h1>
            </div>
            <div class="invoice-meta">
                <p><strong>Fecha:</strong> {{ date('d/m/Y') }}</p>
                @if ($cliente)
                    <p><strong>Cliente:</strong> {{ $cliente->name }}</p>
                @endif
            </div>
        </div>

        <h2 class="text-xl font-bold mb-6">Detalles de la Venta</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Unitario</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($cartItems as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item['quantity'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${{ $item['price'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${{ $item['price'] * $item['quantity'] }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="3" class="px-6 py-4 text-right font-bold">Total</td>
                    <td class="px-6 py-4 font-bold">${{ $total }}</td>
                </tr>
            </tbody>
        </table>
        <button onclick="printInvoice()" class="btn-print">Imprimir Factura</button>
    </div>
    <div class="footer">
        <p>&copy; 2024 Jenecheru. Todos los derechos reservados.</p>
    </div>
    <script>
        function printInvoice() {
            window.print();
            setTimeout(() => {
                window.history.back();
            }, 1000);
        }
    </script>
</body>
</html>
