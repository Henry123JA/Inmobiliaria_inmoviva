<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Impresión de Ventas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Ventas {{ $fecha ? 'para la fecha ' . $fecha : '' }}
                    </div>

                    <div class="mt-6 text-gray-500">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Cliente
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($ventas as $venta)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            {{ $venta->user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            {{ $venta->fecha }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            ${{ $venta->total }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Imprimir
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- CSS para ocultar elementos al imprimir -->
<style>
    /* Oculta el encabezado cuando se imprime */
    @media print {
        x-app-layout x-slot[name="py-12"] {
            display: none !important;
        }
    }
</style>