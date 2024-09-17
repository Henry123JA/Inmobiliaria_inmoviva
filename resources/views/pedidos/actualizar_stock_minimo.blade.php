<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Actualizar Stock Mínimo
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Formulario de Actualización de Stock Mínimo
                    </div>

                    <div class="mt-6 text-gray-500">
                        <form action="{{ route('pedidos.setStockMinimo') }}" method="POST">
                            @csrf
                            <div>
                                <label for="stock_actual" class="block text-sm font-medium text-gray-700">Stock Mínimo Actual:</label>
                                <input type="text" id="stock_actual" name="stock_actual" value="{{ $stockActual }}" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div class="mt-4">
                                <label for="nuevo_stock_minimo" class="block text-sm font-medium text-gray-700">Nuevo Stock Mínimo:</label>
                                <input type="number" id="nuevo_stock_minimo" name="nuevo_stock_minimo" min="0" step="1" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div class="mt-4 flex space-x-4">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Guardar Cambios
                                </button>
                                <a href="{{ route('pedidos.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
