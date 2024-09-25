<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Cliente
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('clientes.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="name" class="block font-medium text-sm text-gray-700">Nombre</label>
                            <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('name', '') }}" required />
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="email" class="block font-medium text-sm text-gray-700">Correo Electrónico</label>
                            <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('email', '') }}" required />
                            @error('email')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="password" class="block font-medium text-sm text-gray-700">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-input rounded-md shadow-sm mt-1 block w-full" required />
                            @error('password')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Rol predeterminado de cliente -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label class="block font-medium text-sm text-gray-700">Rol</label>
                            <p class="text-sm text-gray-600">Cliente</p>
                        </div>

                        <!-- Subida de fotos -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="foto_frontal" class="block font-medium text-sm text-gray-700">Foto Frontal (opcional)</label>
                            <input type="file" name="foto_frontal" id="foto_frontal" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   accept="image/jpeg,image/png,image/jpg" />
                            @error('foto_frontal')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="foto_trasera" class="block font-medium text-sm text-gray-700">Foto Trasera (opcional)</label>
                            <input type="file" name="foto_trasera" id="foto_trasera" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   accept="image/jpeg,image/png,image/jpg" />
                            @error('foto_trasera')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botones ajustados para pantallas pequeñas -->
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
        $('#foto_frontal, #foto_trasera').change(function(e){            
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagenSeleccionada').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });
    });
</script>


