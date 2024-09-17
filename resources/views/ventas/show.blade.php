<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles de Venta - Factura
        </h2>
    </x-slot>

    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f3f4f6;
        }

        .max-w-7xl {
            max-width: 100%;
        }

        .sm\:px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .lg\:px-8 {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .bg-white {
            background-color: #ffffff;
        }

        .overflow-hidden {
            overflow: hidden;
        }

        .shadow-xl {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .sm\:rounded-lg {
            border-radius: 0.5rem;
        }

        .p-6 {
            padding: 1.5rem;
        }

        .sm\:px-20 {
            padding-left: 2.5rem;
            padding-right: 2.5rem;
        }

        .bg-gray-200 {
            background-color: #edf2f7;
        }

        .text-xl {
            font-size: 1.25rem;
        }

        .font-semibold {
            font-weight: 600;
        }

        .mb-6 {
            margin-bottom: 1.5rem;
        }

        .text-2xl {
            font-size: 1.5rem;
        }

        .flex {
            display: flex;
        }

        .justify-between {
            justify-content: space-between;
        }

        .bg-blue-500 {
            background-color: #3f83f8;
        }

        .hover\:bg-blue-700:hover {
            background-color: #1d4ed8;
        }

        .text-white {
            color: #ffffff;
        }

        .font-bold {
            font-weight: 700;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .rounded {
            border-radius: 0.375rem;
        }

        .border-b {
            border-bottom-width: 1px;
        }

        .pb-4 {
            padding-bottom: 1rem;
        }

        .mt-6 {
            margin-top: 1.5rem;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .min-w-full {
            min-width: 100%;
        }

        .border-collapse {
            border-collapse: collapse;
        }

        .border-gray-300 {
            border-color: #d1d5db;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .px-2 {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        .bg-white {
            background-color: #ffffff;
        }

        .bg-gray-300 {
            background-color: #e5e7eb;
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .text-left {
            text-align: left;
        }

        .text-indigo-600 {
            color: #4f46e5;
        }

        .hover\:text-indigo-900:hover {
            color: #21183c;
        }

        .inline-block {
            display: inline-block;
        }

        .ml-4 {
            margin-left: 1rem;
        }

        .text-red-600 {
            color: #ef4444;
        }

        .hover\:text-red-900:hover {
            color: #991b1b;
        }

        .text-green-600 {
            color: #10b981;
        }

        .hover\:text-green-900:hover {
            color: #064e3b;
        }

        .font-medium {
            font-weight: 500;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .leading-4 {
            line-height: 1.4rem;
        }

        .text-gray-800 {
            color: #374151;
        }

        .leading-tight {
            line-height: 1.25;
        }

        .text-gray-500 {
            color: #6b7280;
        }

        .whitespace-no-wrap {
            white-space: nowrap;
        }

        .px-12 {
            padding-left: 3rem;
            padding-right: 3rem;
        }

        .bg-gray-50 {
            background-color: #f9fafb;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .tracking-wider {
            letter-spacing: 0.05em;
        }

        .divide-y {
            border-top-width: 1px;
        }

        .divide-gray-200 {
            border-color: #e5e7eb;
        }

        /* Estilos específicos para impresión */
        @media print {
            body * {
                visibility: hidden;
            }

            #factura, #factura * {
                visibility: visible;
            }

            #factura {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>

    <div id="factura">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="flex justify-between mb-6">
                            <h2 class="text-2xl font-semibold">Factura de Venta</h2>
                            <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Imprimir Factura
                            </button>
                        </div>

                        <div class="mt-6">
                            <div class="flex justify-between border-b pb-4">
                                <div>
                                    <p class="font-semibold">Cliente:</p>
                                    <p>{{ $venta->user->name }}</p>
                                </div>
                                <div>
                                    <p class="font-semibold">Fecha:</p>
                                    <p>{{ $venta->fecha }}</p>
                                </div>
                                <div>
                                    <p class="font-semibold">Total:</p>
                                    <p>${{ $venta->total }}</p>
                                </div>
                                <div>
                                    <p class="font-semibold">Metodo de Pago:</p>
                                    <p>{{ $venta->metodo_de_pago }}</p>
                                </div>
                            </div>

                            <div class="mt-6">
                                <h3 class="text-lg font-semibold">Detalle de Artículos</h3>
                                <table class="min-w-full border-collapse border border-gray-300 mt-4">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Nombre del Artículo</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Cantidad</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Precio Unitario</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($venta->articulos as $articulo)
                                            <tr>
                                                <td class="border border-gray-300 px-4 py-2">{{ $articulo->nombre }}</td>
                                                <td class="border border-gray-300 px-4 py-2">{{ $articulo->pivot->cantidad }}</td>
                                                <td class="border border-gray-300 px-4 py-2">${{ $articulo->pivot->precio_unitario }}</td>
                                                <td class="border border-gray-300 px-4 py-2">${{ $articulo->pivot->cantidad * $articulo->pivot->precio_unitario }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
