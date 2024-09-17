<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Pedido
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Usuario</label>
                            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $user->name }}</p>
                        </div>

                        <div class="mb-6">
                            <label for="proveedor_id" class="block text-sm font-medium text-gray-700">Proveedor</label>
                            <select name="proveedor_id" id="proveedor_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}" @if ($pedido->proveedor_id == $proveedor->id) selected @endif>{{ $proveedor->nombre }}</option>
                                @endforeach
                            </select>
                            @error('proveedor_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $pedido->fecha }}</p>
                        </div>

                        <div class="mb-6">
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" id="estado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                <option value="pendiente" @if ($pedido->estado == 'pendiente') selected @endif>Pendiente</option>
                                <option value="cancelado" @if ($pedido->estado == 'cancelado') selected @endif>Cancelado</option>
                                <option value="recibido" @if ($pedido->estado == 'recibido') selected @endif>Recibido</option>
                            </select>
                            @error('estado')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="total" class="block text-sm font-medium text-gray-700">Total</label>
                            <input type="number" step="0.01" name="total" id="total" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ $pedido->total }}" readonly />
                        </div>

                        <div class="mb-6">
                            <label for="articulos" class="block text-sm font-medium text-gray-700">Artículos</label>
                            <div class="mt-2 overflow-x-auto">
                                <table class="min-w-full bg-white border border-gray-300">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2 border-b text-xs font-medium text-gray-500 uppercase tracking-wider">Artículo</th>
                                            <th class="px-4 py-2 border-b text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                            <th class="px-4 py-2 border-b text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Unitario</th>
                                            <th class="px-4 py-2 border-b text-xs font-medium text-gray-500 uppercase tracking-wider">Importe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($articulos as $articulo)
                                            <tr>
                                                <td class="px-4 py-2 border-b">
                                                    {{ $articulo->nombre }}
                                                    <input type="hidden" name="articulos[{{ $articulo->id }}][id]" value="{{ $articulo->id }}">
                                                </td>
                                                <td class="px-4 py-2 border-b">
                                                    <input type="number" name="articulos[{{ $articulo->id }}][cantidad]" value="{{ $articulo->pivot->cantidad }}" min="0" class="border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 block w-full shadow-sm sm:text-sm rounded-md">
                                                </td>
                                                <td class="px-4 py-2 border-b">
                                                    <input type="number" name="articulos[{{ $articulo->id }}][precio_unitario]" value="{{ $articulo->pivot->precio }}" min="0" step="0.01" class="border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 block w-full shadow-sm sm:text-sm rounded-md">
                                                </td>
                                                <td class="px-4 py-2 border-b">
                                                    <input type="number" value="{{ $articulo->pivot->importe }}" readonly class="border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 block w-full shadow-sm sm:text-sm rounded-md">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6 space-x-4">
                            <a href="{{ route('pedidos.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-700 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
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
