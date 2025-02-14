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
                    <td>Cedula</td>
                    <td>Nombre Completo</td>
                    <td>Estudiantes</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $key)
                    <tr wire:key="item-{{$key->id}}" >
                        <td>{{$key->cedula}}</td>
                        <td>{{$key->nombre}} {{$key->segundo}} {{$key->paterno}} {{$key->materno}}</td>
                        <td>{{ count( $key->representados ) }}</td>
                        <td>
                            <x-button wire:click="editar({{$key->id}})" >
                              <i class="fa-solid fa-pen-to-square"></i>
                            </x-button>
                            <x-button wire:click="estudiante({{$key->id}})" >
                              <i class="fa-solid fa-user-tie"></i>
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
            <h1>Registrar Representante</h1>
        </x-slot>
        <x-slot name='content'>
            <form class="form" id='form-registrar' wire:submit='registrar' >
                <x-label>Cedula</x-label>
                <x-input wire:model='registrarForm.cedula' type="text" name="cedula" placeholder='Cedula' class='w-full'/>
                <x-input-error for="registrarForm.cedula"/>

                <x-label class='mt-4'>Primer Nombre</x-label>
                <x-input wire:model="registrarForm.nombre" type="text" name="nombre" placeholder='Primer Nombre' class='w-full' />
                <x-input-error for="registrarForm.nombre"/>

                <x-label class='mt-4'>Segundo Nombre</x-label>
                <x-input wire:model="registrarForm.segundo" type="text" name="segundo" placeholder='Segundo Nombre' class='w-full'/>
                <x-input-error for="registrarForm.segundo"/>

                <x-label class='mt-4'>Primer Apellido</x-label>
                <x-input wire:model="registrarForm.paterno" type="text" name="paterno" placeholder='Primer Apellido' class='w-full'/>
                <x-input-error for="registrarForm.paterno"/>

                <x-label class='mt-4'>Segundo Apellido</x-label>
                <x-input wire:model="registrarForm.materno" type="text" name="materno" placeholder='Segundo Apellido' class='w-full'/>
                <x-input-error for="registrarForm.materno"/>

                <x-label class='mt-4'>Direccion</x-label>
                <x-input wire:model="registrarForm.direccion" type="text" name="direccion" placeholder='Direccion' class='w-full'/>
                <x-input-error for="registrarForm.direccion"/>

                <x-label class='mt-4'>Telefono</x-label>
                <x-input wire:model="registrarForm.telefono" type="text" name="direccion" placeholder='Telefono' class='w-full'/>
                <x-input-error for="registrarForm.direccion"/>
                	
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
            <h1>Editar Estudiante</h1>
        </x-slot>
        <x-slot name='content'>
            <form class='form' id='form-actualizar' wire:submit='actualizar' >
                <x-label>Cedula</x-label>
                <x-input wire:model='editarForm.cedula' type="number" name="cedula" placeholder='Cedula' class='w-full'/>
                <x-input-error for="editarForm.cedula"/>

                <x-label class='mt-4'>Primer Nombre</x-label>
                <x-input wire:model="editarForm.nombre" type="text" name="nombre" placeholder='Primer Nombre' class='w-full'/>
                <x-input-error for="editarForm.nombre"/>

                <x-label class='mt-4'>Segundo Nombre</x-label>
                <x-input wire:model="editarForm.segundo" type="text" name="segundo" placeholder='Segundo Nombre' class='w-full'/>
                <x-input-error for="editarForm.segundo"/>
                
                <x-label class='mt-4'>Primer Apellido</x-label>
                <x-input wire:model="editarForm.paterno" type="text" name="paterno" placeholder='Primer Apellido' class='w-full'/>
                <x-input-error for="editarForm.paterno"/>
                
                <x-label class='mt-4'>Segundo Apellido</x-label>
                <x-input wire:model="editarForm.materno" type="text" name="materno" placeholder='Segundo Apellido' class='w-full'/>
                <x-input-error for="editarForm.materno"/>
                
                <x-label class='mt-4'>Direccion</x-label>
                <x-input wire:model="editarForm.direccion" type="text" name="direccion" placeholder='Direccion' class='w-full'/>
                <x-input-error for="editarForm.direccion"/>
                
                <x-label class='mt-4'>Telefono</x-label>
                <x-input wire:model="registrarForm.telefono" type="text" name="direccion" placeholder='Telefono' class='w-full'/>
                <x-input-error for="registrarForm.direccion"/>
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
            <h1>Eliminar Estudiante</h1>
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

    <x-dialog-modal wire:model='openEstudiante'>
        <x-slot name='title'>
            <h1>Asignar Estudiante</h1>
        </x-slot>
        <x-slot name='content'>
            <form id='form-representante form' wire:submit='estudianteAsignar' class="flex" >
                        
                <x-select name='representante' wire:model="estudianteForm.idRep" class='w-full'>
                    <option value="" selected> Seleccione </option>
                    @foreach($representantes as $key)
                        <option value="{{$key->id}}">{{$key->cedula.' '.$key->nombre.' '.$key->paterno}}</option>
                    @endforeach
                </x-select>
                    
                <x-input-error for="representanteForm.idRep"/>    

                <x-select wire:model='representanteForm.relacion'>
                    <option value='Legal'>
                        Tutor Legal
                    </option>
                    <option value='Autorizado'>
                        Autorizado
                    </option>
                </x-select>

                <x-input-error for="representanteForm.relacion"/>

                <x-button>Asignar</x-button>
            </form>
                    
            <x-input-error for="representanteForm.idRep"/>    

            <div class="mt-4">
                @foreach($listaRepresentante as $key)
                    <div class="alert alert-success" role="alert">
                      
                      <strong>{{$key->cedula}} </strong> {{$key->nombre}} {{$key->paterno}}

                      (relacion: tutor {{$key->representados[0]->relacion}} )
                      
                      <button wire:click='borrarRep({{$key->id}})' type="button" class="btn-close" aria-label="Close"></button>
                    </div>
                @endforeach
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('openRepresentante',false)" class='mr-2' wire:loading.remove wire:target='representanteAsignar' >
                <i class="fa-solid fa-ban mr-2"></i> 
                Cancelar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model='openEliminarRep'>
        <x-slot name='title'>
            <h1>Desvincular representante</h1>
        </x-slot>
        <x-slot name='content'>
            <form id='form-eliminar-rep' wire:submit='eliminarRep' >
                <h3>Seguro de desvincular ?</h3>
            </form>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('openEliminarRep',false)" class='mr-2' wire:loading.remove wire:target='eliminarRep' >
                <i class="fa-solid fa-ban mr-2"></i> 
                Cancelar
            </x-secondary-button>
            <x-danger-button type='submit' form='form-eliminar-rep'>
                <span wire:loading wire:target='eliminarRep'>Cargando...</span>
                <span wire:loading.remove wire:target='eliminarRep'>
                    <i class="fa-solid fa-trash mr-2"></i> 
                    Desvincular
                </span>
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

</div>