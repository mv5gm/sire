<div>       
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="flex ">
        <x-input class="w-full mr-4" type="text" wire:model.live="buscar" name="" placeholder="Buscar..."/>
        <a>
            <x-button wire:click="registrar">
                <span wire:loading wire:target='registrar'>
                    <i class='fa-solid fa-rotate fa-spin'></i>
                </span>
                <span wire:loading.remove wire:target='registrar'>    
                    <i class="fa-solid fa-plus mr-2"></i> Registrar
                </span>
            </x-button>

            <a href="{{route('nominas.index')}}">  
            <x-button >
                <span wire:loading wire:target='mostrarNomina'>
                    <i class='fa-solid fa-rotate fa-spin'></i>
                </span>
                <span wire:loading.remove wire:target='mostrarNomina'>    
                    <i class="fa-solid fa-money-bill"></i><i class="fa-solid fa-user "></i> Nomina
                </span>
            </x-button>
            </a>
        </a>
    </div>

    <div>
        <table class="tabla w-full mt-4">
            <thead>
                <tr>
                    <td>Cedula</td>
                    <td>Nombre Completo</td>
                    <td>Tipo</td>
                    <td width='100px' class='flex'>Opciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $key)
                    <tr wire:key="item-{{$key->id}}" >
                        <td>{{$key->cedula}}</td>
                        <td>{{$key->nombre}} {{$key->segundo}} {{$key->paterno}} {{$key->materno}}</td>
                        
                        <td>{{$key->tipo}}</td>
                                                
                        <td width='100px' class='flex'>
                            <x-button wire:click="editar({{$key->id}})" >
                              <i class="fa-solid fa-pen-to-square" wire:loading.remove wire.target='editar'></i>
                              <i class='fa-solid fa-rotate fa-spin' wire:loading wire.target='editar'></i>
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
                <h1>Registrar Empleado</h1>
            @else
                <h1>Editar Empleado</h1>
            @endif
        </x-slot>
        <x-slot name='content'>
            <form class="form" id='form-registrar' wire:submit='guardar'>
                
                <x-label>Cedula</x-label>
                
                <x-input type='number' wire:model='form.cedula' name="id" class="w-full" placeholder='Cedula'/>
                
                <x-input-error for="form.cedula"/>

                <x-label class='mt-4'>Primer Nombre</x-label>
                
                <x-input type='text' wire:model='form.nombre' class="w-full" placeholder='Primer Nombre' />
                
                <x-input-error for="form.nombre"/>

                <x-label class='mt-4'>Segundo nombre</x-label>
                
                <x-input type='text' wire:model='form.segundo' class="w-full" placeholder='Segundo Nombre' />
                
                <x-input-error for="form.segundo"/>

				<x-label class='mt-4'>Primer Apellido</x-label>
                
                <x-input type='text' wire:model='form.paterno' class="w-full" placeholder='Primer Apellido'/>
                
                <x-input-error for="form.paterno"/>

				<x-label class='mt-4'>Segundo Apellido</x-label>
                
                <x-input type='text' wire:model='form.materno' class="w-full" placeholder='Segundo Apellido' />
                
                <x-input-error for="form.materno"/>

                <x-label class='mt-4'>Direccion</x-label>
                
                <x-input type='text' wire:model='form.direccion' class="w-full" placeholder='Direccion' />
                
                <x-input-error for="form.direccion"/>

                <x-label class='mt-4'>Tipo de empleado</x-label>
                <x-select wire:model.live="form.tipo" name="forma" class='w-full form-control'>
                    <option value=""  >Seleccione</option>
                    <option value='Obrero'>Obrero</option>
                    <option value='Maestro'>Maestro</option>
                    <option value='Docente'>Docente</option>
                    <option value='Administrativo'>Administrativo</option>
                </x-select>
                <x-input-error for="form.tipo"/>

                @if($form->tipo == 'Docente')
                    <x-label class='mt-4'>Cantidad de horas por semana</x-label>
                    <x-input type='text' wire:model='form.horas' class="w-full" placeholder='Cantidad de horas por semana' />
                    <x-input-error for="form.horas"/>

                @endif

                @if($form->tipo == 'Maestro')
                    <x-label class='mt-4'>Matricula</x-label>
                    <x-input type='text' wire:model='form.matricula' class="w-full" placeholder='Cantidad de estudiantes' />
                    <x-input-error for="form.matricula"/>

                @endif

                @if( $form->tipo == 'Administrativo' || $form->tipo == 'Obrero' )
                    <x-label class='mt-4'>Sueldo</x-label>
                    <x-input type='text' wire:model='form.sueldo' class="w-full" placeholder='Sueldo' />
                    <x-input-error for="form.sueldo"/>

                @endif

                <div wire:loading wire:target="form.tipo" class="mt-4">
                    <i class="fa-solid fa-spinner fa-spin"></i> Cargando...
                </div>

                <x-label class='mt-4'>Banco</x-label>
            	<x-select wire:model='form.banco' class='w-full ' name='banco'>
            		
            		<option value="">Seleccione</option>

            		<option value="BANCO DE VENEZUELA">
            			BANCO DE VENEZUELA
            		</option>
            		<option value="BANCO CENTRAL DE VENEZUELA">
                    	BANCO CENTRAL DE VENEZUELA
            		</option>
            		<option value="BANCO DEL TESORO">
            			BANCO DEL TESORO	
            		</option>
            		<option value="BANCO DEL COMERCIO EXTERIOR (BANCOEX)">
            			BANCO DEL COMERCIO EXTERIOR (BANCOEX)	
            		</option>
            		<option value="BANCO DE EXPORTACION Y COMERCIO">
            			BANCO DE EXPORTACION Y COMERCIO	
            		</option>
            		<option value="BANESCO">
            			BANESCO	
            		</option>
            		<option value="BANCO INDUSTRIAL DE VENEZUELA">
            			BANCO INDUSTRIAL DE VENEZUELA	
            		</option>
            		<option value="BANCO BICENTENARIO">
            			BANCO BICENTENARIO	
            		</option>
            		<option value="BANCO PROVINCIAL">
            			BANCO PROVINCIAL	
            		</option>
            		<option value="CITIBANK SUCURSAL VENEZUELA">
            			CITIBANK SUCURSAL VENEZUELA	
            		</option>
            		<option value="BANCO OCCIDENTAL DEL DESCUENTO">
            			BANCO OCCIDENTAL DEL DESCUENTO	
            		</option>
            		<option value="CORP BANCA">
            			CORP BANCA	
            		</option>
            		<option value="BANCO EXTERIOR">
            			BANCO EXTERIOR	
            		</option>
                    <option value="BANPLUS">
                    	BANPLUS	
                    </option>
                    <option value="BANCO NACIONAL DEL CREDITO">
                    	BANCO NACIONAL DEL CREDITO	
                    </option>
                    <option value="BANCO ACTIVO">
                    	BANCO ACTIVO	
                    </option>
                    <option value="BANCO DEL CARIBE">
                    	BANCO DEL CARIBE	
                    </option>
                    <option value="BANCO FONDO COMUN">
                    	BANCO FONDO COMUN
                    </option>
                    <option value="BANCO MERCANTIL">
                    	BANCO MERCANTIL	
                    </option>
                    <option value="100% BANCO">
                    	100% BANCO	
                    </option>
                    <option value="BANCO SOFITASA">
                    	BANCO SOFITASA
                    </option>
                    <option value="BANCO ESPIRITU SANTO">
                    	BANCO ESPIRITU SANTO
                    </option>
                    <option value="BANCO PLAZA">
                    	BANCO PLAZA	
                    </option>
                    <option value="BANFANB">
                    	BANFANB
                    </option>
            	</x-select>
                <x-input-error for="form.banco"/>

                <x-label class='mt-4'>Numero de cuenta</x-label>
                <x-input wire:model="form.cuenta" type="text"  name="cuenta" placeholder='Numero de cuenta' class='w-full' autocomplete="off" />
                <x-input-error for="form.cuenta"/>
                
                <x-label class='mt-4'>Tipo de cuenta</x-label>
                <x-select wire:model="form.tipo_cuenta" name="tipo_cuenta" class='w-full form-control'>
                    <option value="" >Seleccione</option>
                    <option value='Corriente'>Corriente</option>
                    <option value='Ahorro'>Ahorro</option>
                    <option value='Digital'>Digital</option>
                </x-select>
                <x-input-error for="form.tipo_cuenta"/>
            </form>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('open',false)" class='mr-2' >
                <i class="fa-solid fa-ban mr-2"></i> 
                Cancelar
            </x-secondary-button>
            <x-button type='submit' form='form-registrar' >
                <span wire:loading wire:target='guardar'><i class='fa-solid fa-rotate fa-spin'></i></span>
                <span wire:loading.remove wire:target='guardar'>Guardar</span>
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model='openEliminar'>
        <x-slot name='title'>
            <h1>Eliminar Empleado</h1>
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