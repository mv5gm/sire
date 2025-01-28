<div>       
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="flex ">
        <x-input class="w-full mr-4" type="text" wire:model.live="buscar" name="" placeholder="Buscar..."/>
        <a>
            <x-button wire:click="$set('open',true)">
                <i class="fa-solid fa-plus mr-2"></i>
                Registrar
            </x-button>
        </a>    
        <a href="{{route('export')}}">
            <x-button>
                <i class="fa-solid fa-file-excel mr-2" ></i>Excel
            </x-button>
        </a>
    </div>
    <div>
        <table class="tabla w-full mt-4">
            <thead>
                <tr>
                    <td>nombre</td>
                    <td>Correo</td>
                    <td width='150'>Opciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $key)
                    <tr wire:key="users-{{$key->id}}" >
                        <td>{{$key->name}}</td>
                        <td>{{$key->email}} </td>
                        <td width='150'>
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
            <h1 class="center">Registrar Usuario</h1>
        </x-slot>
        <x-slot name='content'>
           		
            <form class="form mt-2" id='form-registrar' wire:submit='registrar' >
                <x-label>Nombre</x-label>
                <x-input wire:model='form.name' type="text" name="cedula" placeholder='Nombre' class='w-full'/>
                <x-input-error for="form.name"/>

                <x-label class='mt-4'>Correo</x-label>
                <x-input wire:model="form.email" type="text" name="nombre" placeholder='Correo' class='w-full'/>
                <x-input-error for="form.email"/>

                <x-label class='mt-4'>Contraseña</x-label>
                <x-input wire:model="form.password" type="password" name="segundo" placeholder='Contraseña' class='w-full'/>
                <x-input-error for="form.password"/>
                
                <x-label class='mt-4'>Rol</x-label>

                <div >
            		
                	@foreach($rolitos as $rol)
	                	<label>
	            			<input wire:model='roles' type="checkbox" value='{{$rol->name}}'/>
	            			{{$rol->name}}
	            		</label>
                	@endforeach
                						                	
                </div>

            </form>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('open',false)" class='mr-2' >
                <i class="fa-solid fa-ban mr-2"></i> 
            Cancelar
            </x-secondary-button>
            <x-button type='submit' form='form-registrar' >
                <span wire:loading wire:target='registrar'>Cargando...</span>
                <span wire:loading.remove wire:target='registrar'>
                    <i class="fa-solid fa-plus mr-2"></i> 
                Registrar</span>
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model='openEditar'>
        <x-slot name='title'>
            <h1>Editar Usuario</h1>
        </x-slot>
        <x-slot name='content'>
            <form class='form' id='form-actualizar' wire:submit='actualizar' >
                <x-label>Nombre</x-label>
                <x-input wire:model='form.name' type="text" name="cedula" placeholder='Nombre' class='w-full'/>
                <x-input-error for="form.name"/>

                <x-label class='mt-4'>Correo</x-label>
                <x-input wire:model="form.email" type="text" name="nombre" placeholder='Correo' class='w-full'/>
                <x-input-error for="form.email"/>

                <x-label class='mt-4'>Cambiar Contraseña</x-label>
                <x-input wire:model="form.password" type="password" name="segundo" placeholder='Contraseña' class='w-full'/>
                <x-input-error for="form.password"/>
                
                <x-label class='mt-4'>Rol</x-label>

                <div>

                	@foreach($rolitos as $rol)
	                	<label>
	            			<input wire:model='roles' type="checkbox" value='{{$rol->name}}'/>
	            			{{$rol->name}}
	            		</label>
                	@endforeach

                </div>	    
            </form> 
        </x-slot>   
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('openEditar',false)" class='mr-2' >
                <i class="fa-solid fa-ban mr-2"></i> 
            Cancelar
            </x-secondary-button>
            <x-button type='submit' form='form-actualizar' >
                <span wire:loading wire:target='actualizar'>Cargando...</span>
                <span wire:loading.remove wire:target="actualizar">
                    <i class="fa-regular fa-floppy-disk mr-2"></i> 
                    Guardar
                </span>
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model='openEliminar'>
        <x-slot name='title'>
            <h1>Eliminar Usuario</h1>
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