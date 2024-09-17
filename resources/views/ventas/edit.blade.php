<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Venta
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>

                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('ventas.update', $venta->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                            <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if ($user->id == $venta->user_id) selected @endif>{{ $user->name }}</option>
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
                                                <input type="checkbox" id="articulo{{ $articulo->id }}" name="articulos_seleccionados[]" value="{{ $articulo->id }}"
                                                    @foreach ($venta->articulos as $ventaArticulo)
                                                        @if ($ventaArticulo->id == $articulo->id) checked @endif
                                                    @endforeach
                                                    class="ml-2 article-checkbox border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $articulo->nombre }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="number" name="articulos[{{ $articulo->id }}][cantidad]" value="{{ $venta->articulos->firstWhere('id', $articulo->id)->pivot->cantidad ?? 1 }}" min="1" class="article-cantidad border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 block w-full shadow-sm sm:text-sm rounded-md">
                                                @error('articulos.' . $articulo->id . '.cantidad')
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="number" name="articulos[{{ $articulo->id }}][precio_unitario]" value="{{ $venta->articulos->firstWhere('id', $articulo->id)->pivot->precio_unitario ?? $articulo->precio_promedio }}" min="0" step="0.01" class="article-precio border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 block w-full shadow-sm sm:text-sm rounded-md">
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
                                <option value="efectivo" @if ($venta->metodo_de_pago == 'efectivo') selected @endif>Efectivo</option>
                                <option value="tarjeta" @if ($venta->metodo_de_pago == 'tarjeta') selected @endif>Tarjeta</option>
                                <option value="qr" @if ($venta->metodo_de_pago == 'qr') selected @endif>QR</option>
                                <option value="otro" @if ($venta->metodo_de_pago == 'otro') selected @endif>Otro</option>
                            </select>
                            @error('metodo_de_pago')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('ventas.index') }}" class="mr-4 inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-700 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-600 active:bg-indigo-700 focus:outline-none focus:border-indigo-900 focus:shadow-outline-indigo disabled:opacity-25 transition ease-in-out duration-150">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
