<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Artículo
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form method="post" action="{{ route('inventario.update', $articulo->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="shadow overflow-hidden sm:rounded-md">

                    <!-- Código -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="codigo" class="block font-bold text-lg text-gray-700 mb-2">CÓDIGO</label>
                        <input type="text" name="codigo" id="codigo"
                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ old('codigo', $articulo->codigo) }}" />
                        @error('codigo')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nombre -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="nombre" class="block font-bold text-lg text-gray-700 mb-2">NOMBRE</label>
                        <input type="text" name="nombre" id="nombre"
                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ old('nombre', $articulo->nombre) }}" />
                        @error('nombre')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Imagen -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="imagen" class="block font-bold text-lg text-gray-700 mb-2">IMAGEN</label>
                        <input type="file" name="imagen" id="imagen"
                            class="form-input rounded-md shadow-sm mt-1 block w-full" />
                        @if ($articulo->imagen)
                            <img src="{{ asset($articulo->imagen) }}" width="100px" class="mt-2">
                        @endif
                        @error('imagen')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Precio Unitario -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="precio_unitario" class="block font-bold text-lg text-gray-700 mb-2">PRECIO
                            UNITARIO</label>
                        <input type="text" name="precio_unitario" id="precio_unitario"
                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ old('precio_unitario', $articulo->precio_unitario) }}" />
                        @error('precio_unitario')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Precio Mayor -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="precio_mayor" class="block font-bold text-lg text-gray-700 mb-2">PRECIO
                            MAYOR</label>
                        <input type="text" name="precio_mayor" id="precio_mayor"
                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ old('precio_mayor', $articulo->precio_mayor) }}" />
                        @error('precio_mayor')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Precio Promedio -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="precio_promedio" class="block font-bold text-lg text-gray-700 mb-2">PRECIO
                            PROMEDIO</label>
                        <input type="text" name="precio_promedio" id="precio_promedio"
                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ old('precio_promedio', $articulo->precio_promedio) }}" />
                        @error('precio_promedio')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="stock" class="block font-bold text-lg text-gray-700 mb-2">STOCK</label>
                        <input type="text" name="stock" id="stock"
                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ old('stock', $articulo->stock) }}" />
                        @error('stock')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="descripcion" class="block font-bold text-lg text-gray-700 mb-2">DESCRIPCIÓN</label>
                        <textarea name="descripcion" id="descripcion" class="form-textarea rounded-md shadow-sm mt-1 block w-full"
                            placeholder="Agregar descripción del artículo">{{ old('descripcion', $articulo->descripcion) }}</textarea>
                        @error('descripcion')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Categoria -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="categoria_id" class="block font-bold text-lg text-gray-700 mb-2">CATEGORÍA</label>
                        <select name="categoria_id" id="categoria_id"
                            class="form-select rounded-md shadow-sm mt-1 block w-full">
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ $articulo->categoria_id == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Marca -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="marca_id" class="block font-bold text-lg text-gray-700 mb-2">MARCA</label>
                        <select name="marca_id" id="marca_id"
                            class="form-select rounded-md shadow-sm mt-1 block w-full">
                            @foreach ($marcas as $marca)
                                <option value="{{ $marca->id }}"
                                    {{ $articulo->marca_id == $marca->id ? 'selected' : '' }}>
                                    {{ $marca->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('marca_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Modelo -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="modelo_id" class="block font-bold text-lg text-gray-700 mb-2">MODELO</label>
                        <select name="modelo_id" id="modelo_id"
                            class="form-select rounded-md shadow-sm mt-1 block w-full">
                            @foreach ($modelos as $modelo)
                                <option value="{{ $modelo->id }}"
                                    {{ $articulo->modelo_id == $modelo->id ? 'selected' : '' }}>
                                    {{ $modelo->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('modelo_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="flex items-center justify-between px-4 py-3 bg-gray-50 sm:px-6">
                        <div class="flex-1">
                            <a href="{{ route('inventario.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900">
                                Cancelar
                            </a>
                        </div>
                        <div class="flex-1 text-right">
                            <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900">
                                Guardar cambios
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
