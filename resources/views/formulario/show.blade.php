<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle del Formulario: {{ $formulario->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Detalle del Formulario</h1>

                    <div class="grid grid-cols-1 gap-6">
                        <div class="text-lg">
                            <strong>Nombre:</strong> {{ $formulario->nombre }}
                        </div>

                        <div class="text-lg">
                            <strong>Correo:</strong> {{ $formulario->correo }}
                        </div>

                        <div class="text-lg">
                            <strong>Teléfono:</strong> {{ $formulario->telefono }}
                        </div>

                        <div class="text-lg">
                            <strong>Preferencia:</strong> {{ $formulario->mensaje }}
                        </div>

                        <div class="text-lg">
                            <strong>Tipo de Propiedad:</strong> {{ $formulario->tipoPropiedad->nombre ?? 'No especificado' }}
                        </div>

                        <div class="text-lg">
                            <strong>Fecha de Envío:</strong> {{ $formulario->fecha_envio }}
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('formulario.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Volver a la lista
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
