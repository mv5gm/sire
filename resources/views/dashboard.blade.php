<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de control') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">  
                    <div class="flex">
                        <p>Total estudiantes: {{$total_e}}</p>        
                    </div>
                    <div class="flex">
                        <p>Total representantes: {{$total_re}}</p>        
                    </div>
                    <div class="flex">
                        <p>Total de dinero en pagos ($): {{$total_pa}}</p>        
                    </div>
                    <div class="flex">
                        <p>Total dinero en pagos por forma de pago y tipo de pago</p>  
                    </div>  
                    <div class="flex">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Cantidad en Dolares</th>
                                    <th>Cantidad en Bolivares</th>
                                    <th>Forma de Pago</th>
                                    <th>Tipo de pago</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($total_pa_for as $key)
                                    <tr>
                                        <td>{{$key->dolares}}</td>
                                        <td>{{ round($key->bolivares,2)}}</td>
                                        <td>{{$key->forma}}</td>
                                        <td>{{$key->tipo}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>    
                    </div>
                    <div class="flex">
                        <p>Total dinero en pagos por tipo de pago y forma de pago</p>  
                    </div>  
                    <div class="flex">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Cantidad en Dolares</th>
                                    <th>Cantidad en Bolivares</th>
                                    <th>Tipo de Pago</th>
                                    <th>Forma de pago</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($total_pa_tip as $key)
                                    <tr>
                                        <td>{{$key->dolares}}</td>
                                        <td>{{ round($key->bolivares,2) }}</td>
                                        <td>{{$key->tipo}}</td>
                                        <td>{{$key->forma}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
