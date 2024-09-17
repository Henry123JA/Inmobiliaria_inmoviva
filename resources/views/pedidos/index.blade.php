<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Pedidos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-between mb-8">
                <a href="{{ route('pedidos.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 sm:mb-0">Crear un Pedido</a>
                <a href="{{ route('pedidos.actualizarStockMinimoForm') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualizar Stock Mínimo</a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mt-8 text-2xl">
                        Listado de Pedidos
                    </div>

                    <div class="mt-6 text-gray-500 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Usuario
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Proveedor
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Estado
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
                                @foreach ($pedidos as $pedido)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            {{ $pedido->user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            {{ $pedido->proveedor->nombre }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            {{ $pedido->estado }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            {{ $pedido->fecha }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            ${{ $pedido->total }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                            <a href="{{ route('pedidos.show', $pedido->id) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                            <a href="{{ route('pedidos.reporte_ganancia', $pedido->id) }}" class="text-indigo-600 hover:text-indigo-900">Reporte_ganancia</a>
                                            <a href="{{ route('pedidos.edit', $pedido->id) }}" class="ml-4 text-indigo-600 hover:text-indigo-900">Editar</a>
                                            <form class="inline-block" action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este pedido?')">
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
</x-app-layout>
