<div>       
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="flex ">
        <x-input class="w-full mr-4" type="text" wire:model.live="buscar" name="" placeholder="Buscar..."/>
        <a>
            <x-button wire:click="registrar" class="bg-green-500 hover:bg-green-600" >
                <span wire:loading wire:target='registrar'>
                    <i class='fa-solid fa-rotate fa-spin'></i>
                </span>
                <i class='fa-solid fa-plus' wire:loading.remove wire:target='registrar' ></i>
                <span wire:loading.remove wire:target='registrar' class='flex items-center'> 
                     Registrar
                </span>
            </x-button>
        </a>
    </div>
    <div>
        <table class="tabla w-full mt-4">
            <thead>
                <tr>
                    <td>Descripcion</td>
                    <td>Cantidad</td>
                    <td>Forma de Pago</td>
                    <td width='100px' class='flex'>Opciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $key)
                    <tr wire:key="estudiante-{{$key->id}}" >
                        <td>{{$key->descripcion}}</td>
                        <td>
                            {{$key->cantidad}}  
                        </td>
                        <td>{{$key->forma}}</td>
                        <td width="100px" class='flex'>
                            <x-button wire:click="editar({{$key->id}})" >
                              <i class="fa-solid fa-pen-to-square"></i>
                            </x-button>
                            <x-danger-button wire:click="borrar({{$key->id}})">
                                <i class="fa-solid fa-trash"></i>
                            </x-danger-button>
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

            @if(empty($form->id))
                <h1>Registrar Gasto</h1>
            @else
                <h1>Editar Gasto</h1>
            @endif
        </x-slot>
        <x-slot name='content'>
            <form class="form" id='form-registrar' wire:submit='guardar' >
                <x-label>Descripcion</x-label>
                <x-input wire:model='form.descripcion' type="text" name="descripcion" placeholder='Descripcion' class='w-full'/>
                <x-input-error for="form.descripcion"/>

                <x-label class='mt-4'>Forma de Pago</x-label>
                <x-select wire:model.live="form.forma" class="w-full">
                    <option value="">Seleccione</option>    
                    <option value="Divisa">Divisa</option>	
                    <option value="Transferencia">Transferencia</option>	
                    <option value="Efectivo">Efectivo</option>	
                </x-select>
                <x-input-error for="form.forma"/>  

                <x-label class='mt-4'>Precio del dolar <small class='text-primary'>(Opcional)</small></x-label>
                <x-input wire:model.live="form.dolar" type="number" min='0' max='10000000'  name="cantidad" placeholder='Precio del Dolar' step='0.01' class='w-full' />
                <x-input-error for="form.dolar"/>
                
                <x-label class='mt-4'>Cantidad</x-label>
                <x-input wire:model.live="form.cantidad" type="number" min='0' max='10000000'  name="cantidad" placeholder='Cantidad' step='0.01' class='w-full' />
                <x-input-error for="form.cantidad"/>
            </form>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('open',false)" class='mr-2' >
                <i class="fa-solid fa-ban mr-2"></i> 
            Cancelar
            </x-secondary-button>
            <x-button type='submit' form='form-registrar' >
                <span wire:loading wire:target='guardar'>
                    <i class='fa-solid fa-rotate fa-spin'></i>
                </span>
                <span wire:loading.remove wire:target='guardar'>
                    <i class="fa-solid fa-plus mr-2"></i> 
                Guardar</span>
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model='openEliminar'>
        <x-slot name='title'>
            <h1>Eliminar Gasto</h1>
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