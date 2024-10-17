<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Propietarios
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                @canany(['admin_access'])

                <!-- Enlace para agregar un nuevo cliente -->
                <a href="{{ route('users.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Agregar Propietario</a>
                @endcan
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                    <tr>
                                        <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Correo Electrónico
                                        </th>
                                        {{-- <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha de Verificación de Correo
                                        </th> --}}
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Roles
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($propietarios as $propietario)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $propietario->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $propietario->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $propietario->email }}
                                        </td>
                                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $cliente->email_verified_at }}
                                        </td> --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @foreach ($propietario->roles as $role)
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-green-800">
                                                    {{ $role->title }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <!-- Enlaces para ver, editar y eliminar cliente -->
                                        @canany(['admin_access','agente_access'])

                                            <a href="{{ route('users.show', $propietario->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2"> <i class="fas fa-eye text-xl"></i> </a>
                                        @endcanany
                                        @can(['admin_access'])

                                            <a href="{{ route('users.edit', $propietario->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> <i class="fas fa-edit text-xl"></i>  </a>
                                            <a href="{{ route('users.bitacora', $propietario->id) }}" class="text-purple-600 hover:text-purple-900 mb-2 mr-2"> <i class="fas fa-book text-xl"></i>  </a>

                                            <form class="inline-block"
                                                        action="{{ route('users.destroy', $propietario->id) }}" method="POST"
                                                        id="delete{{ $propietario->id }}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="button"
                                                            class="text-red-600 hover:text-red-900 mb-2 mr-2"
                                                            onclick="confirmDelete({{ $propietario->id }})">
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
                    'El Usuario ha sido eliminado.',
                    'success'
                )
            }
        });
    }
</script>