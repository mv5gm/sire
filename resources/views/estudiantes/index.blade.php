<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class='fa-solid fa-user-tie mr-2'></i>    
            Estudiantes
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

                    @livewire('estudiante-crear-live')  
                    @livewire('estudiante-live')  

                </div>
            </div>
        </div>
    </div>
</x-app-layout>