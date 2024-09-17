<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Nueva Venta
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @if ($errors->has('stock_insuficiente'))
                        <div class="mb-4 text-sm text-red-600">
                            {{ $errors->first('stock_insuficiente') }}
                        </div>
                    @endif

                    <form action="{{ route('ventas.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                            <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <input type="text" id="searchArticulo" placeholder="Buscar artículo" class="border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 block w-full shadow-sm sm:text-sm rounded-md mb-2">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seleccionar</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre del Artículo</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Unitario</th>
                                    </tr>
                                </thead>
                                <tbody id="articulosTable" class="bg-white divide-y divide-gray-200">
                                    @foreach ($articulos as $articulo)
                                        <tr class="article-row">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="checkbox" id="articulo{{ $articulo->id }}" name="articulos_seleccionados[]" value="{{ $articulo->id }}" class="ml-2 article-checkbox border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $articulo->nombre }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="number" name="articulos[{{ $articulo->id }}][cantidad]" value="1" min="1" class="article-cantidad border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 block w-full shadow-sm sm:text-sm rounded-md" disabled>
                                                @error('articulos.' . $articulo->id . '.cantidad')
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="number" name="articulos[{{ $articulo->id }}][precio_unitario]" value="{{ $articulo->precio_promedio }}" min="0" step="0.01" class="article-precio border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 block w-full shadow-sm sm:text-sm rounded-md" disabled>
                                                @error('articulos.' . $articulo->id . '.precio_unitario')
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mb-6">
                            <label for="metodo_de_pago" class="block text-sm font-medium text-gray-700">Método de Pago</label>
                            <select name="metodo_de_pago" id="metodo_de_pago" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                <option value="efectivo">Efectivo</option>
                                <option value="tarjeta">Tarjeta</option>
                                <option value="qr">QR</option>
                                <option value="otro">Otro</option>
                            </select>
                            @error('metodo_de_pago')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Crear Venta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchArticulo');
            const articleRows = document.querySelectorAll('.article-row');
            const checkboxes = document.querySelectorAll('.article-checkbox');
            const cantidadInputs = document.querySelectorAll('.article-cantidad');
            const precioInputs = document.querySelectorAll('.article-precio');

            searchInput.addEventListener('input', function () {
                const searchText = this.value.trim().toLowerCase();
                articleRows.forEach(row => {
                    const articleName = row.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
                    if (articleName.includes(searchText)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    const row = this.closest('.article-row');
                    const cantidadInput = row.querySelector('.article-cantidad');
                    const precioInput = row.querySelector('.article-precio');

                    if (this.checked) {
                        cantidadInput.disabled = false;
                        precioInput.disabled = false;
                    } else {
                        cantidadInput.disabled = true;
                        precioInput.disabled = true;
                    }
                });
            });
        });
    </script>
</x-app-layout>
