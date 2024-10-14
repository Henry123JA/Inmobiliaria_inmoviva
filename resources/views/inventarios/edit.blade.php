<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Propiedad del Inventario
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('inventarios.update', $inventario->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md">
                       
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="propiedad_id" class="block font-bold text-lg text-gray-700 mb-2"> Propiedad </label>
                            <select name="propiedad_id" id="propiedad_id"
                                class="form-select rounded-md shadow-sm mt-1 block w-full">
                                @foreach ($propiedades as $propiedad)
                                    <option value="{{ $propiedad->id }}"
                                        {{ $inventario->propiedad_id == $propiedad->id ? 'selected' : '' }}>
                                        {{ $propiedad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('propiedad_id')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="tipopropiedad_id" class="block font-bold text-lg text-gray-700 mb-2"> Tipo de Propiedad </label>
                            <select name="tipopropiedad_id" id="tipopropiedad_id"
                                class="form-select rounded-md shadow-sm mt-1 block w-full">
                                @foreach ($tipoPropiedades as $tipoPropiedad)
                                    <option value="{{ $tipoPropiedad->id }}"
                                        {{ $inventario->tipopropiedad_id == $tipoPropiedad->id ? 'selected' : '' }}>
                                        {{ $tipoPropiedad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipopropiedad_id')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="agente_id" class="block font-bold text-lg text-gray-700 mb-2"> Asignar a un Agente </label>
                            <select name="agente_id" id="agente_id"
                                class="form-select rounded-md shadow-sm mt-1 block w-full">
                                @foreach ($agentes as $agente)
                                    <option value="{{ $agente->id }}"
                                        {{ $inventario->agente_id == $agente->id ? 'selected' : '' }}>
                                        {{ $agente->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('agente_id')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="direccion" class="block font-medium text-sm text-gray-700">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="form-input rounded-md shadow-sm mt-1 block w-full
                                @error('direccion') border-red-500 @enderror" 
                                value="{{ old('direccion', $inventario->direccion) }}" />
                            
                            <!-- Mostrar error si existe -->
                            @error('direccion')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="precio" class="block font-medium text-sm text-gray-700">Precio</label>
                            <input type="text" name="precio" id="precio" class="form-input rounded-md shadow-sm mt-1 block w-full
                                @error('precio') border-red-500 @enderror" 
                                value="{{ old('precio', $inventario->precio) }}" />
                            
                            <!-- Mostrar error si existe -->
                            @error('precio')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="estado" class="block font-medium text-sm text-gray-700">Estado</label>
                            <input type="text" name="estado" id="estado" class="form-input rounded-md shadow-sm mt-1 block w-full
                                @error('estado') border-red-500 @enderror" 
                                value="{{ old('Estado', $inventario->estado) }}" />
                            
                            <!-- Mostrar error si existe -->
                            @error('estado')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="superficie" class="block font-medium text-sm text-gray-700">Superficie</label>
                            <input type="text" name="superficie" id="superficie" class="form-input rounded-md shadow-sm mt-1 block w-full
                                @error('superficie') border-red-500 @enderror" 
                                value="{{ old('superficie', $inventario->superficie) }}" />
                            
                            <!-- Mostrar error si existe -->
                            @error('superficie')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="habitaciones" class="block font-medium text-sm text-gray-700">Habitaciones</label>
                            <input type="text" name="habitaciones" id="habitaciones" class="form-input rounded-md shadow-sm mt-1 block w-full
                                @error('habitaciones') border-red-500 @enderror" 
                                value="{{ old('habitaciones', $inventario->habitaciones) }}" />
                            
                            <!-- Mostrar error si existe -->
                            @error('habitaciones')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="baños" class="block font-medium text-sm text-gray-700">Baños</label>
                            <input type="text" name="baños" id="baños" class="form-input rounded-md shadow-sm mt-1 block w-full
                                @error('baños') border-red-500 @enderror" 
                                value="{{ old('baños', $inventario->baños) }}" />
                            
                            <!-- Mostrar error si existe -->
                            @error('baños')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="descripcion" class="block font-medium text-sm text-gray-700">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-input rounded-md shadow-sm mt-1 block w-full
                                @error('descripcion') border-red-500 @enderror" 
                                value="{{ old('descripcion', $inventario->descripcion) }}" />
                            
                            <!-- Mostrar error si existe -->
                            @error('descripcion')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Vista previa de la imagen -->
                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <img src="{{ $inventario->imagen }}" width="200px" id="imagenSeleccionada">
                        </div>

                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Subir Imagen</label>
                            <div class='flex items-center justify-center w-full'>
                                <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                                    <div class='flex flex-col items-center justify-center pt-7'>
                                        <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Seleccione la imagen</p>
                                    </div>
                                    <input name="imagen" id="imagen" type='file' class="hidden" />
                                </label>
                            </div>

                            <!-- Mostrar error si existe -->
                            @error('imagen')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class='flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5'>
                            <a href="{{ route('inventarios.index') }}" class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'> Cancelar </a>
                            <button type="submit" class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Script para mostrar la vista previa de la imagen -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
<script>
    $(document).ready(function (e) {   
        $('#imagen').change(function(){            
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#imagenSeleccionada').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });
    });
</script>
