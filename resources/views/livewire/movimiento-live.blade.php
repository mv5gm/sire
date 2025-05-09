
<!-- contenido -->
<div>       
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="flex ">
        <x-input class="w-full mr-4" type="text" wire:model.live="buscar" name="" placeholder="Buscar..."/>    
    </div>    
    <div class="flex space-x-4 border-b justify-content-center">
        <!-- Pestañas -->
        <button wire:click="$set('activa', 'divisa')" class="px-4 py-2 border-b-2" :class="{'border-indigo-500': pestañaActiva === 'tab1'}">
            Divisa
        </button>
        <button wire:click="$set('activa', 'transferencia')" class="px-4 py-2 border-b-2" :class="{'border-indigo-500': pestañaActiva === 'tab2'}">
            Transferencia
        </button>
        <button wire:click="$set('activa', 'efectivo')" class="px-4 py-2 border-b-2" :class="{'border-indigo-500': pestañaActiva === 'tab3'}">
            Efectivo
        </button>
    </div>
    
    <div>
        
    </div>    
    <div class="mt-4">
        <div wire:loading wire:target="activa" class="text-center flex justify-content-center">
            <i class='fa-solid fa-rotate fa-spin'></i>
        </div>

        @if ($activa === 'divisa')
            <div>
                <h1>Movimientos en Divisas</h1>
                
                <table class="tabla w-full mt-4">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Cantidad</td>
                            <td>Posicion</td>
                            <td>Forma</td>
                            <td>Tipo</td>
                            <td>Fecha</td>
                            <td width='150'>Opciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($divisas as $key)
                            <tr wire:key="divisa-{{$key->id}}" >
                                <td>{{$key->id}}</td>
                                <td class="{{ $key->tipo === 'Ingreso' ? 'text-blue-500' : 'text-red-500' }}">{{$key->cantidad}}</td>
                                <td>{{$key->posicion}} </td>
                                <td>{{$key->forma}} </td>
                                <td>{{$key->tipo}} </td>
                                <td>{{$key->created_at}} </td>
                                <td width='150'>                            	
                                    <x-button wire:click="ver({{$key->id}})">
                                        <i class="fa-solid fa-eye"></i>
                                    </x-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif ($activa === 'transferencia')
            <div>
                <h1>Movimientos en Transferencia</h1>
                
                <table class="tabla w-full mt-4">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Cantidad</td>
                            <td>Posicion</td>
                            <td>Forma</td>
                            <td>Tipo</td>
                            <td>Fecha</td>
                            <td width='150'>Opciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transferencias as $key)
                            <tr wire:key="transferencia-{{$key->id}}" >
                                <td>{{$key->id}}</td>
                                <td class="{{ $key->tipo === 'Ingreso' ? 'text-blue-500' : 'text-red-500' }}" >{{$key->cantidad}}</td>
                                <td>{{$key->posicion}} </td>
                                <td>{{$key->forma}} </td>
                                <td>{{$key->tipo}} </td>
                                <td>{{$key->created_at}} </td>
                                <td width='150'>                            	
                                    <x-button wire:click="ver({{$key->id}})">
                                        <i class="fa-solid fa-eye"></i>
                                    </x-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif ($activa === 'efectivo')
            <div>
            <h1>Movimientos en Efectivo</h1>
                
                <table class="tabla w-full mt-4">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Cantidad</td>
                            <td>Posicion</td>
                            <td>Forma</td>
                            <td>Tipo</td>
                            <td>Fecha</td>
                            <td width='150'>Opciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($efectivos as $key)
                            <tr wire:key="efectivo-{{$key->id}}" >
                                <td>{{$key->id}}</td>
                                <td class="{{ $key->tipo === 'Ingreso' ? 'text-blue-500' : 'text-red-500' }}">{{$key->cantidad}}</td>
                                <td>{{$key->posicion}}</td>
                                <td>{{$key->forma}}</td>
                                <td>{{$key->tipo}}</td>
                                <td>{{$key->created_at}}</td>
                                <td width="150">                            	
                                    <x-button wire:click="ver({{$key->id}})">
                                        <i class="fa-solid fa-eye"></i>
                                    </x-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    
    @section('scripts')

    @endsection

</div>
<!-- fin del contenido -->
