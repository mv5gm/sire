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
                    <td>Nombres</td>
                    <td>Apellidos</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($estudiantes as $key)
                    <tr wire:key="estudiante-{{$key->id}}" >
                        <td>{{$key->cedula}}</td>
                        <td>{{$key->nombre}} {{$key->segundo}}</td>
                        <td>{{$key->paterno}} {{$key->materno}}</td>
                        <td>
                            <x-button wire:click="editar({{$key->id}})" >
                              <i class="fa-solid fa-pen-to-square"></i>
                            </x-button>
                            <x-button wire:click="representante({{$key->id}})" >
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
        
        {{$estudiantes->links()}}

    </div>
    <x-dialog-modal wire:model='open'>
        <x-slot name='title'>
            <h1 class="center">Registrar Estudiante</h1>
        </x-slot>
        <x-slot name='content'>
            <div class="representante">
                <h5 class="text-center mb-2">Representante</h5>
                <hr>
                <label class="p-2">Nuevo
                    <input type="radio" name="repre" wire:click="$set('mostrarRepresen',true)" />
                </label>
                <label class="p-2">Existente
                    <input type="radio" name="repre" wire:click="$set('mostrarRepresen',false)" checked />
                </label>
                    
                @if($mostrarRepresen)
                
                <div class="registrar-repre p-2 form">
                    <h5 class="text-center mb-2">Registrar representante</h5>
                    <x-label>Cedula del Representante</x-label>
                    <x-input wire:model='representanteRegistrar.cedula' type="text" name="cedula" placeholder='Cedula del Representante' class='w-full'/>
                    <x-input-error for="representanteRegistrar.cedula"/>

                    <x-label class='mt-4'>Primer Nombre del Representante</x-label>
                    <x-input wire:model="representanteRegistrar.nombre" type="text" name="nombre" placeholder='Primer Nombre del Representante' class='w-full'/>
                    <x-input-error for="representanteRegistrar.nombre"/>

                    <x-label class='mt-4'>Segundo Nombre del Representante</x-label>
                    <x-input wire:model="representanteRegistrar.segundo" type="text" name="segundo" placeholder='Segundo Nombre del Representante' class='w-full'/>
                    <x-input-error for="representanteRegistrar.segundo"/>

                    <x-label class='mt-4'>Primer Apellido del Representante</x-label>
                    <x-input wire:model="representanteRegistrar.paterno" type="text" name="paterno" placeholder='Primer Apellido del Representante' class='w-full'/>
                    <x-input-error for="representanteRegistrar.paterno"/>

                    <x-label class='mt-4'>Segundo Apellido del Representante</x-label>
                    <x-input wire:model="representanteRegistrar.materno" type="text" name="materno" placeholder='Segundo Apellido del Representante' class='w-full'/>
                    <x-input-error for="representanteRegistrar.materno"/>

                    <x-label class='mt-4'>Direccion</x-label>
                    <x-input wire:model="representanteRegistrar.direccion" type="text" name="direccion" placeholder='Direccion del Representante' class='w-full mb-2'/>
                    <x-input-error for="representanteRegistrar.direccion"/>
                </div>
                             
                @else
                
                <div class="lista-repre p-2 form">
                    <h5 class="text-center mb-2">Seleccionar Representante</h5>
                    <x-select name='representante' wire:model="representante_id" class='w-full'>
                        <option value="" selected> Seleccione </option>
                        @foreach($representantes as $key)
                            <option value="{{$key->id}}">{{$key->cedula.' '.$key->nombre.' '.$key->paterno}}</option>
                        @endforeach
                    </x-select>
                </div>    
                
                @endif
                
                <hr>   
            </div>  
           
            <form class="form mt-2" id='form-registrar' wire:submit='registrar' >
                <x-label>Cedula</x-label>
                <x-input wire:model='estudianteRegistrar.cedula' type="text" name="cedula" placeholder='Cedula' class='w-full'/>
                <x-input-error for="estudianteRegistrar.cedula"/>

                <x-label class='mt-4'>Primer Nombre</x-label>
                <x-input wire:model="estudianteRegistrar.nombre" type="text" name="nombre" placeholder='Primer Nombre' class='w-full'/>
                <x-input-error for="estudianteRegistrar.nombre"/>

                <x-label class='mt-4'>Segundo Nombre</x-label>
                <x-input wire:model="estudianteRegistrar.segundo" type="text" name="segundo" placeholder='Segundo Nombre' class='w-full'/>
                <x-input-error for="estudianteRegistrar.segundo"/>

                <x-label class='mt-4'>Primer Apellido</x-label>
                <x-input wire:model="estudianteRegistrar.paterno" type="text" name="paterno" placeholder='Primer Apellido' class='w-full'/>
                <x-input-error for="estudianteRegistrar.paterno"/>

                <x-label class='mt-4'>Segundo Apellido</x-label>
                <x-input wire:model="estudianteRegistrar.materno" type="text" name="materno" placeholder='Segundo Apellido' class='w-full'/>
                <x-input-error for="estudianteRegistrar.materno"/>

                <x-label class='mt-4'>Fecha de nacimiento</x-label>
                <x-input wire:model="estudianteRegistrar.fecha" type="date" name="fecha" placeholder='Fecha de nacimiento' class='w-full'/>
                <x-input-error for="estudianteRegistrar.fecha"/>

                <x-label class='mt-4'>Lugar de nacimiento</x-label>
                <x-input wire:model="estudianteRegistrar.lugar" type="text" name="lugar" placeholder='Lugar de nacimiento' class='w-full'/>
                <x-input-error for="estudianteRegistrar.lugar"/>

                <x-label class='mt-4'>Sexo</x-label>
                <x-select wire:model="estudianteRegistrar.sexo" name="sexo" class='w-full form-control'>
                    <option value="" disabled="">Seleccione</option>
                    <option value="m">Masculino</option>
                    <option value="f">Femenina</option>
                </x-select>
                <x-input-error for="estudianteRegistrar.sexo"/>

                <x-label class='mt-4'>Nivel Academico</x-label>
                <x-select wire:model="estudianteRegistrar.nivel_id" name="nivel" class='w-full form-control'>
                    <option value=""  disabled="">Seleccione</option>
                    @foreach($nivels as $key)
                        <option value='{{$key->id}}'>{{$key->nombre}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="estudianteRegistrar.nivel_id"/>

                <x-label class='mt-4'>Seccion</x-label>
                <x-select wire:model="estudianteRegistrar.seccion_id" name="seccion" class='w-full form-control'>
                    <option value="" disabled="">Seleccione</option>
                    @foreach($seccions as $key)
                        <option value="{{$key->id}}">{{$key->nombre}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="estudianteRegistrar.seccion_id"/>

                <x-label class='mt-4'>Año escolar</x-label>
                <x-select wire:model="estudianteRegistrar.aescolar_id" name="aescolar_id" class='w-full form-control'>
                    <option value="" disabled="">Seleccione</option>
                    @foreach($aescolars as $key)
                        <option value="{{$key->id}}">{{$key->inicio}}-{{$key->final}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="estudianteRegistrar.aescolar_id"/>
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
                <x-input wire:model='estudianteEditar.cedula' type="number" name="cedula" placeholder='Cedula' class='w-full'/>
                <x-input-error for="estudianteEditar.cedula"/>

                <x-label class='mt-4'>Primer Nombre</x-label>
                <x-input wire:model="estudianteEditar.nombre" type="text" name="nombre" placeholder='Primer Nombre' class='w-full'/>
                <x-input-error for="estudiantEditar.nombre"/>

                <x-label class='mt-4'>Segundo Nombre</x-label>
                <x-input wire:model="estudianteEditar.segundo" type="text" name="segundo" placeholder='Segundo Nombre' class='w-full'/>
                <x-input-error for="estudianteEditar.segundo"/>
                
                <x-label class='mt-4'>Primer Apellido</x-label>
                <x-input wire:model="estudianteEditar.paterno" type="text" name="paterno" placeholder='Primer Apellido' class='w-full'/>
                <x-input-error for="estudianteEditar.paterno"/>
                
                <x-label class='mt-4'>Segundo Apellido</x-label>
                <x-input wire:model="estudianteEditar.materno" type="text" name="materno" placeholder='Segundo Apellido' class='w-full'/>
                <x-input-error for="estudianteEditar.materno"/>
                
                <x-label class='mt-4'>Fecha de nacimiento</x-label>
                <x-input wire:model="estudianteEditar.fecha" type="date" name="fecha" placeholder='Fecha de nacimiento' class='w-full'/>
                <x-input-error for="estudianteEditar.fecha"/>
                
                <x-label class='mt-4'>Lugar de nacimiento</x-label>
                <x-input wire:model="estudianteEditar.lugar" type="text" name="lugar" placeholder='Lugar de nacimiento' class='w-full'/>
                <x-input-error for="estudianteEditar.lugar"/>
                
                <x-label class='mt-4'>Sexo</x-label>
                <x-select wire:model="estudianteEditar.sexo" name="sexo" class='w-full form-control'>
                    <option value="" disabled>Seleccione</option>
                    <option value="m">Masculino</option>
                    <option value="f">Femenina</option>
                </x-select>
                <x-input-error for="estudianteEditar.sexo"/>
                
                <x-label class='mt-4'>Nivel Academico</x-label>
                <x-select wire:model="estudianteEditar.nivel_id" name="nivel" class='w-full form-control'>
                    <option value="" disabled >Seleccione</option>
                    @foreach($nivels as $key)
                        <option value='{{$key->id}}'>{{$key->nombre}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="estudianteEditar.nivel_id"/>
                
                <x-label class='mt-4'>Seccion</x-label>
                <x-select wire:model="estudianteEditar.seccion_id" name="seccion" class='w-full form-control'>
                    <option value="" disabled>Seleccione</option>
                    @foreach($seccions as $key)
                        <option value="{{$key->id}}">{{$key->nombre}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="estudianteEditar.seccion_id"/>

                <x-label class='mt-4'>Año escolar</x-label>
                <x-select wire:model="estudianteEditar.aescolar_id" name="aescolar" class='w-full form-control'>
                    <option value="" disabled>Seleccione</option>
                    @foreach($aescolars as $key)
                        <option value="{{$key->id}}">{{$key->inicio}}-{{$key->final}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="estudianteEditar.aescolar_id"/>    
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

    <x-dialog-modal wire:model='openRepresentante'>
        <x-slot name='title'>
            <h1>Asignar Representante</h1>
        </x-slot>
        <x-slot name='content'>
            <form id='form-representante form' wire:submit='representanteAsignar' class="flex" >        
                        
                <x-select name='representante' wire:model="representanteForm.idRep" class='w-full'>
                    <option value="" selected> Seleccione </option>
                    @foreach($representantes as $key)
                        <option value="{{$key->id}}">{{$key->cedula.' '.$key->nombre.' '.$key->paterno}}</option>
                    @endforeach
                </x-select>

                <x-button>Asignar</x-button>
            </form>
            
            <x-input-error for="representanteForm.idRep"/>    

            <div class="mt-4">
                @foreach($listaRepresentante as $key)
                    <div class="alert alert-success" role="alert">
                      <strong>{{$key->cedula}}</strong>{{$key->nombre}} {{$key->paterno}}
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