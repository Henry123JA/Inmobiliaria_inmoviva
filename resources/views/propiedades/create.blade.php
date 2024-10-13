<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Propiedad
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form id="propiedadForm" method="post" action="{{ route('propiedades.store') }}" enctype="multipart/form-data">
                     @csrf {{--  protege app contra ataques --}}
                    <div class="shadow overflow-hidden sm:rounded-md">
                        
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="nombre" class="block font-medium text-sm text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            <p id="errorNombre" class="text-red-500 text-xs mt-2 hidden">El nombre es obligatorio.</p>
                        </div>
                        
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="estado" class="block font-medium text-sm text-gray-700">Estado</label>
                            <input type="text" name="estado" id="estado" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            <p id="errorEstado" class="text-red-500 text-xs mt-2 hidden">El estado es obligatorio.</p>
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="descripcion" class="block font-medium text-sm text-gray-700">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            <p id="errorDescripcion" class="text-red-500 text-xs mt-2 hidden">La descripción es obligatoria.</p>
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

                        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                            <a href="{{ route('propiedades.index') }}" class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancelar</a>
                            <button type="submit" class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Guardar</button>
                        </div>                                         
                    </div>
                </form>
            </div>
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
