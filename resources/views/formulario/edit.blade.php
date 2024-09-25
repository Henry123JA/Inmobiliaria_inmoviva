<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Formulario
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('formulario.update', $formulario->id) }}">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="nombre" class="block font-medium text-sm text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('nombre', $formulario->nombre) }}" />
                            @error('nombre')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="correo" class="block font-medium text-sm text-gray-700">Correo</label>
                            <input type="email" name="correo" id="correo" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('correo', $formulario->correo) }}" />
                            @error('correo')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="telefono" class="block font-medium text-sm text-gray-700">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('telefono', $formulario->telefono) }}" />
                            @error('telefono')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="mensaje" class="block font-medium text-sm text-gray-700">Preferencia</label>
                            <input type="text" name="mensaje" id="mensaje" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('mensaje', $formulario->mensaje) }}" />
                            @error('mensaje')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="tipo_de_propiedad" class="block font-medium text-sm text-gray-700">Tipo de Propiedad</label>
                            <select name="tipo_de_propiedad_id" id="tipo_de_propiedad" class="form-multiselect rounded-md shadow-sm mt-1 block w-full">
                                @foreach($tiposDePropiedad as $tipo)
                                    <option value="{{ $tipo->id }}"{{ $tipo->id == old('tipo_de_propiedad_id', $formulario->tipo_de_propiedad_id) ? ' selected' : '' }}>
                                        {{ $tipo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_de_propiedad_id')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <a href="{{ route('formulario.index') }}" class="inline-flex items-center px-4 py-2 mr-4 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                            <button class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Actualizar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
