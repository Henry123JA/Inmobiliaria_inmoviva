<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard - Inmobiliaria Inmoviva') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="border border-gray-300 p-6 rounded-lg">
                    <h3 class="text-2xl font-semibold mb-6 text-center">Información de la Inmobiliaria</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="flex items-center border-b border-gray-300 py-3">
                            <div class="w-full sm:w-1/4"><strong>Nombre de la Empresa:</strong></div>
                            <div class="w-full sm:w-3/4 text-gray-700">Inmoviva</div>
                        </div>
                        <div class="flex items-center border-b border-gray-300 py-3">
                            <div class="w-full sm:w-1/4"><strong>Teléfono:</strong></div>
                            <div class="w-full sm:w-3/4 text-gray-700">(591) 6757-8461</div>
                        </div>
                        <div class="flex items-center border-b border-gray-300 py-3">
                            <div class="w-full sm:w-1/4"><strong>Correo Electrónico:</strong></div>
                            <div class="w-full sm:w-3/4 text-gray-700">info@inmoviva.com</div>
                        </div>
                        <div class="flex items-center border-b border-gray-300 py-3">
                            <div class="w-full sm:w-1/4"><strong>Ubicación:</strong></div>
                            <div class="w-full sm:w-3/4 text-gray-700">Santa Cruz De La Sierra </div>
                        </div>
                        <div class="flex items-start py-3">
                            <div class="w-full sm:w-1/4"><strong>Detalles:</strong></div>
                            <div class="w-full sm:w-3/4 text-gray-700">Inmoviva es una inmobiliaria enfocada en ofrecer una amplia gama de propiedades, tanto para venta como alquiler. Nos especializamos en brindar un servicio personalizado que garantiza satisfacer las necesidades habitacionales y de inversión de nuestros clientes, con un enfoque en calidad, transparencia y compromiso..</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
