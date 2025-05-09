<x-app-layout>
    <x-slot name="header">
        <div class='flex'>    
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                <i class='fa-solid fa-money fa-user'></i>    
                Usuarios
            </h2>
            <a href="{{route('roles.index')}}"> 
                <i class='fa-solid fa-user-gear'></i> 
                Ver Roles 
            </a>
        </div>    
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

                    @livewire('user-live')  

                </div>
            </div>
        </div>
    </div>
</x-app-layout>