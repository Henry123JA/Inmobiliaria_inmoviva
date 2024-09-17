<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Ventas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mt-8 text-2xl">
                        Listado de Ventas
                    </div>

                    <div class="mt-6 text-gray-500">
                        <div class="flex justify-end mb-6 space-x-4">
                            <a href="{{ route('ventas.create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                Nueva Venta
                            </a>
                            <button onclick="imprimirVentas('dia')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Imprimir Ventas del Día
                            </button>
                            <button onclick="imprimirVentas('mes')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Imprimir Ventas del Mes
                            </button>
                            <button onclick="imprimirVentas('anio')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Imprimir Ventas del Año
                            </button>
                        </div>

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
                                    <th class="px-6 py-3 bg-gray-50"></th>
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
                                        <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                            <a href="{{ route('ventas.show', $venta->id) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                            <form class="inline-block" action="{{ route('ventas.destroy', $venta->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta venta?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="ml-4 text-red-600 hover:text-red-900">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function imprimirVentas(periodo) {
            // Obtener la fecha actual
            let fecha = new Date();
            let dia = fecha.getDate();
            let mes = fecha.getMonth() + 1; // Los meses van de 0 a 11 en JavaScript
            let anio = fecha.getFullYear();

            // Generar la URL para la impresión según el período seleccionado
            let url = '';
            if (periodo === 'dia') {
                url = `{{ route('ventas.print', ['periodo' => 'dia', 'fecha' => '']) }}/${anio}-${mes}-${dia}`;
            } else if (periodo === 'mes') {
                url = `{{ route('ventas.print', ['periodo' => 'mes', 'fecha' => '']) }}/${anio}-${mes}`;
            } else if (periodo === 'anio') {
                url = `{{ route('ventas.print', ['periodo' => 'anio', 'fecha' => '']) }}/${anio}`;
            }

            // Abrir la ventana para imprimir
            window.open(url, '_blank');
        }
    </script>
</x-app-layout>
