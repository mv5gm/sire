
<!-- contenido -->
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
                    <td>Año</td>
                    <td>Nivel</td>
                    <td>Seccion</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $key)
                    <tr wire:key="item-{{$key->id}}" >
                        <td>{{$key->aescolar->inicio.'-'.$key->aescolar->final}}</td>
                        <td>{{$key->nivel->nombre}}</td>
                        <td>{{$key->seccion->nombre}}</td>
                                                
                        <td>

                            <x-button wire:click="editar({{$key->id}})" >
                              <i class="fa-solid fa-pen-to-square"></i>
                            </x-button>
                            
                            <x-danger-button wire:click="borrar({{$key->id}})">
                                <i class="fa-solid fa-trash"></i>
                            </x-danger-button>
                        </td>
                    </tr>
                @empty
                	<tr>
                		<td>
                			Sin Resultados
                		</td>
                	</tr>    
                @endforelse
            </tbody>
        </table>
    </div>    
    <div class="mt-4">
        
    </div>
    <x-dialog-modal wire:model='open'>
        <x-slot name='title'>
            <h1>Registrar Planificacion Anual</h1>
        </x-slot>
        <x-slot name='content'>
            <form class="form" id='form-registrar' wire:submit='registrar'>
                
                <x-label>Año escolar</x-label>
                
                <x-select wire:model='form.aescolar_id' class='w-full mb-4'>
                	<option value="">Selecione</option>
                	@foreach($aescolars as $key)
                		<option value="{{$key->id}}">
                		{{$key->inicio.'-'.$key->final}}
                		</option>
                	@endforeach

                </x-select>

                <x-input-error for="form.aescolar_id"/>

                <x-label>Nivel Academico</x-label>
                
                <x-select wire:model='form.nivel_id' class='w-full mb-4'>
                	<option value="">Selecione</option>
                	@foreach($nivels as $key)
                		<option value="{{$key->id}}">
                		{{$key->nombre}}
                		</option>
                	@endforeach

                </x-select>

                <x-input-error for="form.nivel_id"/>

                <x-label>Seccion</x-label>
                
                <x-select wire:model='form.seccion_id' class='w-full'>
                	<option value="">Selecione</option>
                	@foreach($seccions as $key)
                		<option value="{{$key->id}}">
                		{{$key->nombre}}
                		</option>
                	@endforeach

                </x-select>

                <x-input-error for="form.seccion_id"/>

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
            <h1>Editar Planificacion anual</h1>
        </x-slot>
        <x-slot name='content'>
            <form class="form" id='form-editar' wire:submit='actualizar'>
                <x-label>Año escolar</x-label>
                
                <x-select wire:model='form.aescolar_id' class='w-full mb-4'>
                	
                	@foreach($aescolars as $key)
                		<option value="{{$key->id}}">
                		{{$key->inicio.'-'.$key->final}}
                		</option>
                	@endforeach

                </x-select>

                <x-input-error for="form.aescolar_id"/>

                <x-label>Nivel Academico</x-label>
                
                <x-select wire:model='form.nivel_id' class='w-full mb-4'>
                	
                	@foreach($nivels as $key)
                		<option value="{{$key->id}}">
                		{{$key->nombre}}
                		</option>
                	@endforeach

                </x-select>

                <x-input-error for="form.nivel_id"/>

                <x-label>Seccion</x-label>
                
                <x-select wire:model='form.seccion_id' class='w-full'>
                	
                	@foreach($seccions as $key)
                		<option value="{{$key->id}}">
                		{{$key->nombre}}
                		</option>
                	@endforeach

                </x-select>

                <x-input-error for="form.seccion_id"/>

            </form>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('openEditar',false)" class='mr-2' >
                <i class="fa-solid fa-ban mr-2"></i> 
            Cancelar
            </x-secondary-button>
            <x-button type='submit' form='form-editar' >
                <span wire:loading wire:target='actualizar'>Cargando...</span>
                <span wire:loading.remove wire:target='actualizar'>
                    <i class="fa-solid fa-save mr-2"></i> 
               	Editar</span>
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model='openEliminar'>
        <x-slot name='title'>
            <h1>Eliminar Pago</h1>
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

    @section('scripts')

    @endsection

</div>
<!-- fin del contenido -->
