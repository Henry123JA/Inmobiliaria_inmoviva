<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Cliente
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('clientes.update', $cliente->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="shadow overflow-hidden sm:rounded-md">
                        {{-- Nombre del Cliente --}}
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="name" class="block font-medium text-sm text-gray-700">Nombre</label>
                            <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ $cliente->user->name }}" />
                        </div>

                        {{-- Email del Cliente --}}
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ $cliente->user->email }}" />
                        </div>

                        {{-- Rol (predefinido como Cliente) --}}
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="role" class="block font-medium text-sm text-gray-700">Rol</label>
                            <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Cliente
                            </div>
                        </div>

                        {{-- Foto Frontal Actual --}}
                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <label for="foto_frontal" class="block font-medium text-sm text-gray-700">Foto Frontal Actual</label>
                            @if ($cliente->foto_frontal)
                                <img src="{{ asset('clientes_fotos/' . $cliente->foto_frontal) }}" class="w-32 h-32 sm:w-24 sm:h-24" id="fotoFrontalSeleccionada">
                            @else
                                <p>No hay foto frontal disponible</p>
                            @endif
                        </div>

                        {{-- Subir Nueva Foto Frontal --}}
                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <label for="foto_frontal" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Subir Nueva Foto Frontal</label>
                            <div class="flex items-center justify-center w-full">
                                <label class="flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group">
                                    <div class="flex flex-col items-center justify-center pt-7">
                                        <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <p class="lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider">Seleccione una nueva imagen</p>
                                    </div>
                                    <input type="file" name="foto_frontal" id="foto_frontal" class="hidden">
                                </label>
                            </div>
                        </div>

                        {{-- Foto Trasera Actual --}}
                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <label for="foto_trasera" class="block font-medium text-sm text-gray-700">Foto Trasera Actual</label>
                            @if ($cliente->foto_trasera)
                                <img src="{{ asset('clientes_fotos/' . $cliente->foto_trasera) }}" class="w-32 h-32 sm:w-24 sm:h-24" id="fotoTraseraSeleccionada">
                            @else
                                <p>No hay foto trasera disponible</p>
                            @endif
                        </div>

                        {{-- Subir Nueva Foto Trasera --}}
                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <label for="foto_trasera" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Subir Nueva Foto Trasera</label>
                            <div class="flex items-center justify-center w-full">
                                <label class="flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group">
                                    <div class="flex flex-col items-center justify-center pt-7">
                                        <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <p class="lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider">Seleccione una nueva imagen</p>
                                    </div>
                                    <input type="file" name="foto_trasera" id="foto_trasera" class="hidden">
                                </label>
                            </div>
                        </div>

                        {{-- Botones de acción --}}
                        <div class="flex flex-col sm:flex-row items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 space-y-4 sm:space-y-0 sm:space-x-4">
                            <a href="{{ route('clientes.index') }}" class="w-full sm:w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2 text-center">Cancelar</a>
                            <button type="submit" class="w-full sm:w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
<script>
    $(document).ready(function (e) {
        $('#foto_frontal').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#fotoFrontalSeleccionada').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#foto_trasera').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#fotoTraseraSeleccionada').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
