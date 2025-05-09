<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class='fa-solid fa-chart-line mr-2'></i>    
        {{ __('Panel de control') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class='p-6 lg:p-8 bg-white border-b border-gray-200'>
                    <div class='flex items-center justify-between'>
                        <h1 class="text-2xl font-bold">Estadisticas Financieras</h1>
                        <a href=" {{route('movimientos')}} ">
                            <i class='fa-solid fa-money-bill'></i>
                            Ver Movimientos Financieros
                        </a>
                    </div>
                </div>
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">  
                    @livewire('alumno-live')
                </div>
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">  
                    <div style="width: 75%; margin: auto;">
                        @php
                           // <canvas id="myChart"></canvas>
                        @endphp
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const ctx = document.getElementById('myChart').getContext('2d');
                            const myChart = new Chart(ctx, {
                                type: 'bar', // Tipo de gráfica (bar, line, pie, etc.)
                                data: {
                                    labels: @json($meses), // Pasar las etiquetas desde PHP
                                    datasets: [{
                                        label: 'Cantidad de ingresos por mes',
                                        data: @json($cantidades), // Pasar los datos desde PHP
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                     plugins: {
                                        datalabels: {
                                            color: '#000', // Color del texto
                                            anchor: 'end', // Posición del texto (end = arriba de la barra)
                                            align: 'top', // Alineación del texto
                                            formatter: (value) => {
                                                return value; // Muestra el valor tal cual
                                            }
                                        }
                                    }
                                }
                            });
                        }); 
                    </script>
                </div>
            </div>
            
            @can('users.index')

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <button class="btn btn-primary ">
                    Crear respaldo DB
                </button>
            </div>

            @endcan

        </div>
    </div>

    
</x-app-layout>
