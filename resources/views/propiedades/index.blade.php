<x-app-layout>
    <div class="bg-gray-200 min-h-screen">

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lista de Propiedades
            </h2>
        </x-slot>
        <div>


            </table>
            @if (session('success'))
                <div id="success-message"
                    class="fixed top-14 right-5 bg-green-500 text-white text-center py-2 px-4 rounded shadow-lg z-50">
                    {{ session('success') }}
                </div>
            @endif
            <script>
                setTimeout(function() {
                    document.getElementById('success-message').style.display = 'none';
                }, 2000); // Ocultar el mensaje después de 2 seg
            </script>

            <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 ">
                <div class="block mb-8">
                    @canany(['admin_access','agente_access','propietario_access'])

                        <a href="{{ route('propiedades.create') }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Propiedades</a>
                    @endcan
                </div>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 w-full">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="100"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                                                ID
                                            </th>
                                            <th scope="col" width="100"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Name
                                            </th>
                                            <th scope="col" width="100"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Estado
                                            </th>
                                            <th scope="col" width="100"
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                 Descripcion
                                              </th>                                            
                                            <th scope="col" width="100"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Imagen
                                            </th>
                                            <th scope="col" width="100"
                                                class="px-9 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($propiedades as $propiedad)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $propiedad->id }}
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $propiedad->nombre }}
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $propiedad->estado }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $propiedad->descripcion }}
                                                </td>                                                
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <img src="{{ $propiedad->imagen }}" width="180px">
                                                </td>
                                                @canany(['admin_access', 'agente_access','propietario_access'])
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <a href="{{ route('propiedades.show', $propiedad->id) }}"
                                                            class="text-green-600 hover:text-green-900 mb-2 mr-2">
                                                            <i class="fa-solid fa-eye text-xl"></i>
                                                        </a>
                                                @endcanany
                                                @can('admin_access')
                                                        <a href="{{ route('propiedades.edit', $propiedad->id) }}"
                                                            class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">
                                                            <i class="fa-solid fa-edit text-xl"></i>
                                                        </a>
                                                        <form class="inline-block"
                                                            action="{{ route('propiedades.destroy', $propiedad->id) }}" method="POST"
                                                            id="delete{{ $propiedad->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="text-red-600 hover:text-red-900 mb-2 mr-2"
                                                                onclick="confirmDelete({{ $propiedad->id }})">
                                                                <i class="fas fa-trash text-xl"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Deseas eliminar este registro.",
            icon: 'warning',
            showCancelButton: true,

            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete' + id).submit();
                Swal.fire(
                    'Eliminado!',
                    'La Propiedad ha sido eliminado.',
                    'success'
                )
            }
        });
    }
</script>
