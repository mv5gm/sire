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
            <h1 class="center">{{ $id ? 'Actualizar' : 'Registrar' }} Ingreso</h1>
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
                @if($esTransferencia)
                	<x-label>Codigo</x-label>
                	<x-input wire:model='form.codigo' type="text" placeholder='Codigo' class='w-full mb-2'/>
                	<x-input-error for="form.codigo"/>
                @endif  
                <x-label>Descripcion <small>(opcional)</small></x-label>
                <x-input wire:model='form.descripcion' type="text" placeholder='Descripcion' class='w-full mb-2'/>
                <x-input-error for="form.descripcion"/>
                 <!-- Checkbox para indicar si es un pago -->
		        <div>		
		            <label>		
		                <input type="checkbox" wire:model.live="form.esPago"> ¿Es un pago de Representante?
		            </label>
		        </div>

                @if($form->esPago)
					<!-- Selector de representante -->
                	<div>
		                <label for="representante_id" class='w-full'>Representante:</label>
		                <x-select id="representante_id" wire:model.live="form.representante_id" class='w-full' required>
		                    <option value="">Seleccione un representante</option>
		                    @foreach ($representantes as $key)
		                        <option value="{{ $key->id }}">{{ $key->nombre }}</option>
		                    @endforeach
		                </x-select>
                		<x-input-error for="form.representante_id"/>
		            </div>
		            <!-- Selector de estudiante -->
		            <div>
		                <label for="estudiante_id" class='w-full'>Estudiante:</label>
		                <x-select id="estudiante_id" wire:model="form.estudiante_id" class='w-full' required>
		                    <option value="">Seleccione un estudiante</option>
		                    @foreach ($estudiantes as $key)
		                        <option value="{{ $key->id }}">{{ $key->cedula.' '.$key->nombre.' '.$key->paterno }}</option>
		                    @endforeach
		                </x-select>
                		<x-input-error for="form.estudiante_id"/>
		            </div>

		            <!-- Selector de tipo de pago -->
		            <div>
		                <label for="tipoPago" class='w-full'>Tipo de pago:</label>
		                <x-select id="tipoPago" wire:model.live="form.tipoPago" class='w-full' required>
		                    <option value="">Seleccione un tipo de pago</option>
		                    @foreach ($form->tiposPago as $key)
		                        <option value="{{ $key }}">{{ $key }}</option>
		                    @endforeach
		                </x-select>
                		<x-input-error for="form.tipoPago"/>
		            </div>	

		            <!-- Selector de meses (solo si el tipo de pago es mensualidad) -->
		            @if ($form->tipoPago == 'Mensualidad')
		                <div>
		                    <label class='w-full'>Meses a pagar:</label>
		                    @foreach ($form->meses as $key => $mes)
		                        <label class='p-2'>
		                            <input type="checkbox" wire:model="form.mesesSeleccionados" value="{{ $key+1 }}"> {{ $mes }}
		                        </label>
		                    @endforeach
		                </div>
		            @endif
                @endif
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
                {{ $id ? 'Actualizar' : 'Registrar' }}</span>
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