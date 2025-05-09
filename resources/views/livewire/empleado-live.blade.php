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
                    <div class='border p-2 mt-4'>
                        <h3 class='p-1'>Asignar Secciones</h3>
                        <x-label class='mt-4'>Nivel Academico</x-label>
                        <x-select wire:model="cursa.nivel_id" name="nivel" class='w-full form-control'>
                            <option value="" disabled >Seleccione</option>
                            @foreach($nivels as $key)
                                <option value='{{$key->id}}'>{{$key->nombre}}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="cursa.nivel_id"/>
                        
                        <x-label class='mt-4'>Seccion</x-label>
                        <x-select wire:model="cursa.seccion_id" name="seccion" class='w-full form-control'>
                            <option value="" disabled>Seleccione</option>
                            @foreach($seccions as $key)
                                <option value="{{$key->id}}">{{$key->nombre}}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="cursa.seccion_id"/>

                        <x-label class='mt-4'>Año escolar</x-label>
                        <x-select wire:model="cursa.aescolar_id" name="aescolar" class='w-full form-control'>
                            <option value="" disabled>Seleccione</option>
                            @foreach($aescolars as $key)
                                <option value="{{$key->id}}">{{$key->inicio}}-{{$key->final}}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="cursa.aescolar_id"/>
                    </div>
                    
                    <h3 class='m-2'> Secciones Anteriores </h3>
                    
                    @foreach($impartes as $key)
                        <div class='p-2 m-2 bg-light border flex radius'>
                            <div class='flex flex-1'>
                                <p class='mr-2'> {{ $key->cursa->nivel->nombre }} </p>
                                <p class='mr-2'> {{ $key->cursa->seccion->nombre }} </p>
                                <p> {{ $key->cursa->aescolar->inicio.'-'.$key->cursa->aescolar->final }} </p>
                            </div>
                            <div>
                                <a wire:click="borrarImparte({{$key->id}})" class='p-1 cursor-pointer' title='Eliminar'>
                                    <i class="fa-solid fa-x"></i>
                                </a>    
                            </div>    
                        </div>
                    @endforeach

                @endif

                @if( $form->tipo == 'Administrativo' || $form->tipo == 'Obrero' )
                    <x-label class='mt-4'>Sueldo</x-label>
                    <x-input type='text' wire:model='form.sueldo' class="w-full" placeholder='Sueldo en Dolares' />
                    <x-input-error for="form.sueldo"/>
                @endif

                <div wire:loading wire:target="form.tipo" class="mt-4">
                    <i class="fa-solid fa-spinner fa-spin"></i> Cargando...
                </div>

                <x-label class='mt-4'>Banco</x-label>
            	<x-select wire:model='form.banco' class='w-full ' name='banco'>
            		
                    <option value="">Seleccione</option>
                    @foreach( $bancos as $bank)
                        <option value="{{ $bank }}">{{ $bank }}</option>
                    @endforeach
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

    <x-dialog-modal wire:model='openEliminarImparte'>
        <x-slot name='title'>
            <h1>Desvincular Maestro con esta Seccion</h1>
        </x-slot>
        <x-slot name='content'>
            <form id='form-eliminar-imparte' wire:submit='eliminarImparte' >
                <h3>Seguro de desvincular ?</h3>
            </form>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('openEliminarImparte',false)" class='mr-2' wire:loading.remove wire:target='eliminar' >
                <i class="fa-solid fa-ban mr-2"></i> 
                Cancelar
            </x-secondary-button>
            <x-danger-button type='submit' form='form-eliminar-imparte'>
                <span wire:loading wire:target='eliminarImparte'><i class='fa fa-rotate spin'></i></span>
                <span wire:loading.remove wire:target='eliminarImparte'>
                    <i class="fa-solid fa-trash mr-2"></i> 
                    Eliminar
                </span>
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

    @section('scripts')

    @endsection

</div>