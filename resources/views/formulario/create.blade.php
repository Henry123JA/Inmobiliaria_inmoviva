<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Formulario
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('formulario.store') }}">
                    @csrf {{-- Protege la aplicación contra ataques CSRF --}}
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="nombre" class="block font-medium text-sm text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('nombre') }}">
                            @error('nombre')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="correo" class="block font-medium text-sm text-gray-700">Correo</label>
                            <input type="email" name="correo" id="correo" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('correo') }}">
                            @error('correo')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="telefono" class="block font-medium text-sm text-gray-700">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('telefono') }}">
                            @error('telefono')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="mensaje" class="block font-medium text-sm text-gray-700">Preferencia</label>
                            <textarea name="mensaje" id="mensaje" rows="5" class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('mensaje') }}</textarea>
                            @error('mensaje')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="tipo_de_propiedad" class="block font-medium text-sm text-gray-700">Selecciona el Tipo de Propiedad</label>
                            <select name="tipo_de_propiedad_id" id="tipo_de_propiedad" class="form-input rounded-md shadow-sm mt-1 block w-full">
                                @foreach($tiposDePropiedad as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5">
                            <a href="{{ route('formulario.index') }}" class="w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2">Cancelar</a>
                            <button type="submit" class="w-auto bg-green-500 hover:bg-green-700 rounded-lg shadow-xl font-medium text-white px-4 py-2">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
