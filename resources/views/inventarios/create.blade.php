<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Propiedad para el Inventario
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form method="post" action="{{ route('inventarios.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="shadow overflow-hidden sm:rounded-md">

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="propiedad_id" class="block font-bold text-lg text-gray-700 mb-2">Propiedad</label>
                        <select name="propiedad_id" id="propiedad_id" class="form-input rounded-md shadow-sm mt-1 block w-full">
                            @foreach($propiedades as $propiedad)
                                <option value="{{ $propiedad->id }}">{{ $propiedad->nombre }}</option>
                            @endforeach
                        </select>
                        @error('propiedad_id')
                            <p class="text-sm text-red-600">El campo es obligatorio</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="tipopropiedad_id" class="block font-bold text-lg text-gray-700 mb-2">Tipo de Propiedad</label>
                        <select name="tipopropiedad_id" id="tipopropiedad_id" class="form-input rounded-md shadow-sm mt-1 block w-full">
                            @foreach($tipoPropiedades as $tipoPropiedad)
                                <option value="{{ $tipoPropiedad->id }}">{{ $tipoPropiedad->nombre }}</option>
                            @endforeach
                        </select>
                        @error('tipopropiedad_id')
                            <p class="text-sm text-red-600">El campo es obligatorio</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="agente_id" class="block font-bold text-lg text-gray-700 mb-2"> Asignar a un Agente </label>
                        <select name="agente_id" id="agente_id" class="form-input rounded-md shadow-sm mt-1 block w-full">
                            @foreach($agentes as $agente)
                                <option value="{{ $agente->id }}">{{ $agente->nombre }}</option>
                            @endforeach
                        </select>
                        @error('agente_id')
                            <p class="text-sm text-red-600">El campo es obligatorio</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        {!! Form::label('fecha', 'Fecha', ['class' => "block font-bold text-lg text-gray-700 mb-2"]) !!}
                        {!! Form::date('fecha', null, ['class' => "form-input rounded-md shadow-sm mt-1 block w-full"]) !!}
                        @error('fecha')
                            <p class="text-sm text-red-600">El campo es obligatorio</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="direccion" class="block font-medium text-sm text-gray-700">Dirección</label>
                        <textarea name="direccion" id="direccion" class="form-input rounded-md shadow-sm mt-1 block w-full" required>{{ old('direccion') }}</textarea>
                        @error('direccion')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="precio" class="block font-medium text-sm text-gray-700">Precio</label>
                        <textarea name="precio" id="precio" class="form-input rounded-md shadow-sm mt-1 block w-full" required>{{ old('precio') }}</textarea>
                        @error('precio')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="estado" class="block font-medium text-sm text-gray-700">Estado</label>
                        <textarea name="estado" id="estado" class="form-input rounded-md shadow-sm mt-1 block w-full" required>{{ old('estado') }}</textarea>
                        @error('estado')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="superficie" class="block font-medium text-sm text-gray-700">Superficie</label>
                        <textarea name="superficie" id="superficie" class="form-input rounded-md shadow-sm mt-1 block w-full" required>{{ old('superficie') }}</textarea>
                        @error('superficie')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="habitaciones" class="block font-medium text-sm text-gray-700">Habitaciones</label>
                        <textarea name="habitaciones" id="habitaciones" class="form-input rounded-md shadow-sm mt-1 block w-full" required>{{ old('superficie') }}</textarea>
                        @error('habitaciones')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="baños" class="block font-medium text-sm text-gray-700">Baños</label>
                        <textarea name="baños" id="baños" class="form-input rounded-md shadow-sm mt-1 block w-full" required>{{ old('baños') }}</textarea>
                        @error('baños')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="descripcion" class="block font-medium text-sm text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-input rounded-md shadow-sm mt-1 block w-full" required>{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6 mt-5 mx-7">
                        <img id="imagenSeleccionada" style="max-height: 300px;">
                    </div>

                    <div class="grid grid-cols-1 mt-5 mx-7">
                        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Subir Imagen</label>
                        <div class='flex items-center justify-center w-full'>
                            <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                                <div class='flex flex-col items-center justify-center pt-7'>
                                    <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class='text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Seleccione la imagen</p>
                                </div>
                                <input name="imagen" id="imagen" type='file' class="hidden" />
                            </label>
                        </div>
                        <p id="errorImagen" class="text-red-500 text-xs mt-2 hidden">Debe seleccionar una imagen.</p>
                    </div>

                    <div class="flex items-center justify-between px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <a href="{{ route('inventarios.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-bold rounded-md">Cancelar</a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 text-white font-bold rounded-md">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
<script>   
    $(document).ready(function () {   
        // Previsualización de la imagen seleccionada
        $('#imagen').change(function(){            
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#imagenSeleccionada').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });

        // Validación del formulario antes de enviar
        $('#propiedadForm').submit(function(event) {
            let valid = true;

            // Validar nombre
            if ($('#nombre').val().trim() === '') {
                $('#errorNombre').removeClass('hidden');
                valid = false;
            } else {
                $('#errorNombre').addClass('hidden');
            }

            // Validar estado
            if ($('#estado').val().trim() === '') {
                $('#errorEstado').removeClass('hidden');
                valid = false;
            } else {
                $('#errorEstado').addClass('hidden');
            }

            // Validar descripción
            if ($('#descripcion').val().trim() === '') {
                $('#errorDescripcion').removeClass('hidden');
                valid = false;
            } else {
                $('#errorDescripcion').addClass('hidden');
            }

            // Validar imagen
            if ($('#imagen').get(0).files.length === 0) {
                $('#errorImagen').removeClass('hidden');
                valid = false;
            } else {
                $('#errorImagen').addClass('hidden');
            }

            if (!valid) {
                event.preventDefault(); // Detener el envío si hay errores
            }
        });
    });
</script>
