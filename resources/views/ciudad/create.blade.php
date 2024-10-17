<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Ciudad
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8">
            <a href="{{ route('ciudad.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Regresar</a>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form method="post" action="{{ route('ciudad.store') }}">
                @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="nombre" class="block font-medium text-sm text-gray-700">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('nombre') }}" required>
                        @error('nombre')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="descripcion" class="block font-medium text-sm text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <a href="{{ route('ciudad.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-bold rounded-md">Cancelar</a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 text-white font-bold rounded-md">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>