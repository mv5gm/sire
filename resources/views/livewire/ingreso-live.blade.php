<div>       
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="flex ">
        <x-input class="w-full mr-4" type="text" wire:model.live="buscar" name="" placeholder="Buscar..."/>
        <a>
            <x-button wire:click="abrirModal">
                <i class="fa-solid fa-plus mr-2"></i>
                Registrar
            </x-button>
        </a>
    </div>
    <div>
        <table class="tabla w-full mt-4">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Cantidad</td>
                    <td>Forma</td>
                    <td>Fecha</td>
                    <td width='150'>Opciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $key)
                    <tr wire:key="users-{{$key->id}}" >
                        <td>{{$key->id}}</td>
                        <td>{{$key->cantidad}}</td>
                        <td>{{$key->forma}} </td>
                        <td>{{$key->fecha}} </td>
                        <td width='150'>
                        	@can('ingresos.edit')
	                            <x-button wire:click="editar({{$key->id}})" >
	                              <i class="fa-solid fa-pen-to-square"></i>
	                            </x-button>
                            @endcan
                            	
                            @can('ingresos.destroy')
	                            <x-danger-button wire:click="borrar({{$key->id}})">
	                                <i class="fa-solid fa-trash"></i>
	                            </x-danger-button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>    
    <div class="mt-4">
        
        {{$items->links()}}

    </div>
    <x-dialog-modal wire:model='open'>
        <x-slot name='title'>
            <h1 class="center">{{ $form->id ? 'Actualizar' : 'Registrar' }} Ingreso</h1>
        </x-slot>
        <x-slot name='content'>
           		
            <form class="form mt-2" id='form-registrar' wire:submit='guardar' >
                
                <x-label>Cantidad</x-label>
                <x-input wire:model='form.cantidad' type="number" placeholder='Cantidad' class='w-full mb-2'/>
                <x-input-error for="form.cantidad"/>
                
                <x-label>Dolar</x-label>
                <x-input wire:model='form.dolar' type="number" placeholder='Dolar' class='w-full mb-2'/>
                <x-input-error for="form.dolar"/>
                
                <x-label>Forma de pago</x-label>
                <x-select wire:model.live='form.forma' class='w-full mb-2'>
                	<option value="">Seleccione</option>	
                	@foreach($form->formas as $key)
                        <option value="{{ $key }}">{{ $key }}</option>	
                    @endforeach	
                </x-select>
                <x-input-error for="form.forma"/>
                @if($form->forma == 'Transferencia')
                	<x-label>Codigo</x-label>
                	<x-input wire:model='form.codigo' type="text" placeholder='Codigo' class='w-full mb-2'/>
                	<x-input-error for="form.codigo"/>
                @endif  
                <x-label>Descripcion <small>(Opcional)</small></x-label>
                <x-input wire:model='form.descripcion' type="text" placeholder='Descripcion' class='w-full mb-2'/>
                <x-input-error for="form.descripcion"/>
                
                <x-label>Fecha <small>(Opcional)</small></x-label>
                <x-input wire:model='form.fecha' type="date" class='w-full mb-2'/>
                <x-input-error for="form.fecha"/>
            </form>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('open',false)" class='mr-2' >
                <i class="fa-solid fa-ban mr-2"></i> 
            Cancelar
            </x-secondary-button>
            <x-button type='submit' form='form-registrar' >
                <span wire:loading wire:target='guardar'>Cargando...</span>
                <span wire:loading.remove wire:target='guardar'>
                    <i class="fa-solid fa-plus mr-2"></i> 
                {{ $form->id ? 'Actualizar' : 'Registrar' }}</span>
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model='openEliminar'>
        <x-slot name='title'>
            <h1>Eliminar Ingreso</h1>
        </x-slot>
        <x-slot name='content'>
            <form id='form-eliminar' wire:submit='eliminar' >
                <h3>Seguro de eliminar ?</h3>
            </form>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('openEliminar',false)" class='mr-2' wire:loading.remove wire:target='eliminar' >
                <i class="fa-solid fa-ban mr-2"></i> 
                Cancelar
            </x-secondary-button>
            <x-danger-button type='submit' form='form-eliminar'>
                <span wire:loading wire:target='eliminar'>Cargando...</span>
                <span wire:loading.remove wire:target='eliminar'>
                    <i class="fa-solid fa-trash mr-2"></i> 
                    Eliminar
                </span>
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>