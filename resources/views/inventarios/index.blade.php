<x-app-layout>
    <div class="bg-gray-200 min-h-screen">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lista de Propiedades (Inventario)
            </h2>
        </x-slot>


        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <!-- Campo de búsqueda -->
            <form method="GET" action="{{ route('inventario.buscar') }}" class="flex items-center mb-6">
                <input type="text" name="search" placeholder="Buscar propiedades..."
                    class="border border-gray-300 rounded-md py-2 px-4 mr-2 w-full sm:w-1/3" value="{{ request('search') }}">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buscar</button>
            </form>
            
            <!-- Filtros -->
            <div class="flex justify-between flex-wrap mb-6">
                <form method="GET" action="{{ route('inventario.filtrar') }}" class="w-full md:w-2/3">
                    @csrf
                    <div class="filters flex flex-wrap gap-4">
                        <select id="buscapropiedad" name="buscapropiedad" 
                            class="form-control border border-gray-300 rounded-md py-2 px-3 w-full md:w-auto" 
                            style="color: #000000;">
                            <option value="">Tipo de Propiedad</option>
                            <option value="Todos" {{ request('buscapropiedad') == 'Todos' ? 'selected' : '' }}>Todos</option>
                            <option value="Casa" {{ request('buscapropiedad') == 'Casa' ? 'selected' : '' }}>Casa</option>
                            <option value="Apartamento" {{ request('buscapropiedad') == 'Apartamento' ? 'selected' : '' }}>Apartamento</option>
                            <option value="Terreno" {{ request('buscapropiedad') == 'Terreno' ? 'selected' : '' }}>Terreno</option>
                            <option value="Local Comercial" {{ request('buscapropiedad') == 'Local Comercial' ? 'selected' : '' }}>Local Comercial</option>
                            <option value="Oficina" {{ request('buscapropiedad') == 'Oficina' ? 'selected' : '' }}>Oficina</option>
                        </select>
        
                        <input type="number" id="buscasuperficiedesde" name="buscasuperficiedesde" 
                            class="form-control border border-gray-300 rounded-md py-2 px-3 w-full md:w-1/4" 
                            placeholder="Superficie desde" value="{{ request('buscasuperficiedesde') }}">
                        
                        <input type="number" id="buscasuperficiehasta" name="buscasuperficiehasta" 
                            class="form-control border border-gray-300 rounded-md py-2 px-3 w-full md:w-1/4" 
                            placeholder="Superficie hasta" value="{{ request('buscasuperficiehasta') }}">
                        
                        <select id="agente" name="agente" 
                            class="form-control border border-gray-300 rounded-md py-2 px-3 w-full md:w-auto" 
                            style="color: #000000;">
                            <option value="">Estado</option>
                            <option value="Todos" {{ request('agente') == 'Todos' ? 'selected' : '' }}>Todos</option>
                            <option value="Disponible" {{ request('agente') == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                        </select>
        
                        <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full md:w-auto">Filtrar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 ">
            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div id="success-message" class="fixed top-14 right-5 bg-green-500 text-white text-center py-2 px-4 rounded shadow-lg z-50">
                    {{ session('success') }}
                </div>
            @endif

            <script>
                setTimeout(function() {
                    const successMessage = document.getElementById('success-message');
                    if (successMessage) {
                        successMessage.style.display = 'none';
                    }
                }, 2000); // Ocultar el mensaje después de 2 seg
            </script>


            <!-- Campo de búsqueda -->
            <form action="" method="GET" class="max-w-6xl mx-auto sm:px-2 lg:px-4 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Del Día -->
                    <div class="flex flex-col items-center">
                        <label for="from_date" class="text-sm font-medium text-gray-700 mb-1">Del Día</label>
                        <input type="date" name="from_date" id="from_date" value="{{ request()->input('from_date') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Hasta el Día -->
                    <div class="flex flex-col items-center">
                        <label for="to_date" class="text-sm font-medium text-gray-700 mb-1">Hasta el Día</label>
                        <input type="date" name="to_date" id="to_date" value="{{ request()->input('to_date') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Botón Buscar -->
                    <div class="flex items-end ">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Buscar
                        </button>
                    </div>

                    <div class="flex items-end ">
                        <button type="submit" formaction="{{ route('export') }}"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Generar Reporte PDF
                        </button>
                    </div>
                </div>
            </form>

            <div class="block mb-8">
                @canany(['admin_access', 'agente_access', 'propietario_access'])
                    <a href="{{ route('inventarios.create') }}"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Agregar Propiedades al Inventario</a>
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
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col" width="100"
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Propiedad
                                        </th>
                                        <th scope="col" width="100"
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tipo de Propiedad
                                        </th>
                                        <th scope="col" width="100"
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Agente Asignado
                                        </th>
                                        <th scope="col" width="100"
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha
                                        </th>
                                        <th scope="col" width="100"
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Dirección
                                        </th>
                                        <th scope="col" width="100"
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Estado
                                        </th>
                                        <th scope="col" width="100"
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Superficie
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
                                    @foreach ($inventarios as $inventario)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $inventario->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $inventario->propiedad->nombre ?? 'No asignada' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $inventario->tipoPropiedad->nombre ?? 'No asignado' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $inventario->agente->nombre ?? 'No asignado' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $inventario->fecha }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $inventario->direccion }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $inventario->estado }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $inventario->superficie }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <img src="{{ $inventario->imagen }}" width="290px">
                                            </td>
                                            @canany(['admin_access', 'agente_access', 'propietario_access'])
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="{{ route('inventarios.show', $inventario->id) }}"
                                                        class="text-green-600 hover:text-green-900 mb-2 mr-2">
                                                        <i class="fa-solid fa-eye text-xl"></i>
                                                    </a>
                                            @endcanany
                                            @can('admin_access')
                                                <a href="{{ route('inventarios.edit', $inventario->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">
                                                    <i class="fa-solid fa-edit text-xl"></i>
                                                </a>

                                                <form class="inline-block"
                                                    action="{{ route('inventarios.destroy', $inventario->id) }}"
                                                    method="POST" id="delete{{ $inventario->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="text-red-600 hover:text-red-900 mb-2 mr-2"
                                                        onclick="confirmDelete({{ $inventario->id }})">
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
                    'La Propiedad ha sido eliminado del Inventario',
                    'success'
                )
            }
        });
    }
</script>
