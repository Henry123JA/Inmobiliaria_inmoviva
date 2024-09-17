<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Marcas
        </h2>
    </x-slot>
    <div>
        

    </table>
    @if(session('success'))
        <div id="success-message" class="alert alert-success text-green-600 bg-green-200 border border-green-200 p-4 my-4">
            {{ session('success') }}
        </div>
    @endif
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 2000); // Ocultar el mensaje después de 2 seg
    </script>
    
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 " >
            <div class="block mb-8">
                
                <a href="{{ route('marca.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Marca</a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                                        ID
                                    </th>
                                    <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                     <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Creación
                                    </th>
                                    <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Pais_Origen
                                    </th>
                                    <th scope="col"  width="100" class="px-9 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones
                                    </th>                                                                     
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($marcs as $marc)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $marc->id }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $marc->nombre }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $marc->creacion }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <img src="/imagen/{{$marc->imagen}}" width="30%">
                                        </td>                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                                                           
                                            <a href="{{ route('marca.show', $marc->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>
                                            <a href="{{ route('marca.edit', $marc->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>                                              
              
                                            <form class="inline-block" action="{{ route('marca.destroy', $marc->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')                                                
                                                <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
                                            </form>
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
