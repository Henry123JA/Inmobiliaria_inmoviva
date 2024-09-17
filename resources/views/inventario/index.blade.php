<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Articulos
        </h2>
    </x-slot>

    <div>
        @livewire('articulo-index')
    </div>
</x-app-layout>
