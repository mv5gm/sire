<div>       
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="flex ">
        <x-input class="w-full mr-4" type="text" wire:model.live="buscar" name="" placeholder="Buscar..."/>
        <div class='flex'>
            
            <x-button wire:click='mostrarFormulario'>
                <i class="fa-solid fa-plus mr-2"></i>
                Inscripcion
            </x-button>
            <x-button wire:click='mostrarFormularioEstudiante'>
                <i class="fa-solid fa-plus mr-2"></i>
                Estudiante
            </x-button>
        </div>
    </div>
    <div>
        <table class="tabla w-full mt-4">
            <thead>
                <tr>
                    <td>Cedula</td>
                    <td>Nombre Completo</td>
                    <td>Seccion</td>
                    <td width='250' >Opciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($estudiantes as $key)
                    <tr wire:key="estudiante-{{$key->id}}" >
                        <td>{{$key->cedula}}</td>
                        <td>{{$key->nombre}} {{$key->segundo}} {{$key->paterno}} {{$key->materno}}
                        </td>
                        <td>
                            {{$key->inscripcions[0]->cursa->nivel->nombre}}  
                        </td>
                        <td width='250'>
                            @can('estudiantes.edit')
                            <x-button wire:click="editar({{$key->id}})" >
                              <i class="fa-solid fa-pen-to-square"></i>
                            </x-button>
                            @endcan
                            
                            @can('estudiantes.destroy')
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
        
        {{$estudiantes->links()}}

    </div>

    <x-dialog-modal wire:model='openEditar'>
        <x-slot name='title'>
            <h1>Editar Estudiante</h1>
        </x-slot>
        <x-slot name='content'>
            <form class='form' id='form-actualizar' wire:submit='actualizar' >
                <x-label>Cedula</x-label>
                <x-input wire:model='form.cedula' type="number" name="cedula" placeholder='Cedula' class='w-full'/>
                <x-input-error for="form.cedula"/>

                <x-label class='mt-4'>Primer Nombre</x-label>
                <x-input wire:model="form.nombre" type="text" name="nombre" placeholder='Primer Nombre' class='w-full'/>
                <x-input-error for="form.nombre"/>

                <x-label class='mt-4'>Segundo Nombre</x-label>
                <x-input wire:model="form.segundo" type="text" name="segundo" placeholder='Segundo Nombre' class='w-full'/>
                <x-input-error for="form.segundo"/>
                
                <x-label class='mt-4'>Primer Apellido</x-label>
                <x-input wire:model="form.paterno" type="text" name="paterno" placeholder='Primer Apellido' class='w-full'/>
                <x-input-error for="form.paterno"/>
                
                <x-label class='mt-4'>Segundo Apellido</x-label>
                <x-input wire:model="form.materno" type="text" name="materno" placeholder='Segundo Apellido' class='w-full'/>
                <x-input-error for="form.materno"/>
                
                <x-label class='mt-4'>Fecha de nacimiento</x-label>
                <x-input wire:model="form.fecha" type="date" name="fecha" placeholder='Fecha de nacimiento' class='w-full'/>
                <x-input-error for="form.fecha"/>
                
                <x-label class='mt-4'>Lugar de nacimiento</x-label>
                <div class="border p-1">    
                    <div class="flex flex-column flex-md-row">    
                        <x-select wire:model.live='estado_id' class="flex-grow-1 m-1">
                            <option value="">Estado</option>
                            @foreach($estados as $key)
                                <option value="{{$key->id}}">{{$key->nombre}}</option>
                            @endforeach
                        </x-select>
                        <x-select wire:model.live='municipio_id' class="flex-grow-1 m-1">
                            <option value="">Municipio</option>
                            @foreach($municipios as $key)
                                <option value="{{$key->id}}">{{$key->nombre}}</option>
                            @endforeach
                        </x-select>
                        <x-select wire:model.live='form.parroquia_id' class="flex-grow-1 m-1">
                            <option value="">Parroquia</option>
                            @foreach($parroquias as $key)
                                <option value="{{$key->id}}">{{$key->nombre}}</option>
                            @endforeach
                        </x-select>
                    </div>    
                    <x-input wire:model="form.lugar" type="text" name="lugar" placeholder='Referencia' class='w-full'/>
                    <x-input-error for="form.lugar"/>
                </div>
                
                <x-label class='mt-4'>Sexo</x-label>
                <x-select wire:model="form.sexo" name="sexo" class='w-full form-control'>
                    <option value="" disabled>Seleccione</option>
                    <option value="m">Masculino</option>
                    <option value="f">Femenina</option>
                </x-select>
                <x-input-error for="form.sexo"/>

                <x-label class='mt-4'>Tipo de Estudiante</x-label>
                <x-select wire:model="form.tipo" class='w-full form-control'>
                    <option value="" disabled>Seleccione</option>
                    <option value="Normal">Normal</option>
                    <option value="Especial">Especial</option>
                    <option value="Exonerado">Exonerado</option>
                </x-select>
                <x-input-error for="form.tipo"/>
                
                <div class='border p-2 mt-4'>
                    <h3 class='p-1'>Inscripcion</h3>
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

    <x-dialog-modal wire:model='open'>
        <x-slot name='title'>
            <h1>Registrar Estudiante</h1>
        </x-slot>
        <x-slot name='content'>
            <form class='form' id='form-registrar' wire:submit='registrarEstudiante' >
                <h3 class='border p-2 mt-4 text-center'>Datos Personales</h3>
                
                <x-label>Cedula</x-label>
                <x-input wire:model='form.cedula' type="number" name="cedula" placeholder='Cedula' class='w-full'/>
                <x-input-error for="form.cedula"/>

                <x-label class='mt-4'>Primer Nombre</x-label>
                <x-input wire:model="form.nombre" type="text" name="nombre" placeholder='Primer Nombre' class='w-full'/>
                <x-input-error for="form.nombre"/>

                <x-label class='mt-4'>Segundo Nombre</x-label>
                <x-input wire:model="form.segundo" type="text" name="segundo" placeholder='Segundo Nombre' class='w-full'/>
                <x-input-error for="form.segundo"/>
                
                <x-label class='mt-4'>Primer Apellido</x-label>
                <x-input wire:model="form.paterno" type="text" name="paterno" placeholder='Primer Apellido' class='w-full'/>
                <x-input-error for="form.paterno"/>
                
                <x-label class='mt-4'>Segundo Apellido</x-label>
                <x-input wire:model="form.materno" type="text" name="materno" placeholder='Segundo Apellido' class='w-full'/>
                <x-input-error for="form.materno"/>
                
                <x-label class='mt-4'>Fecha de nacimiento</x-label>
                <x-input wire:model="form.fecha" type="date" name="fecha" placeholder='Fecha de nacimiento' class='w-full'/>
                <x-input-error for="form.fecha"/>
                
                <x-label class='mt-4'>Lugar de nacimiento</x-label>
                <div class="border p-1">    
                    <div class="flex flex-column flex-md-row">    
                        <x-select wire:model.live='estado_id' class="flex-grow-1 m-1">
                            <option value="">Estado</option>
                            @foreach($estados as $key)
                                <option value="{{$key->id}}">{{$key->nombre}}</option>
                            @endforeach
                        </x-select>
                        <x-select wire:model.live='municipio_id' class="flex-grow-1 m-1">
                            <option value="">Municipio</option>
                            @foreach($municipios as $key)
                                <option value="{{$key->id}}">{{$key->nombre}}</option>
                            @endforeach
                        </x-select>
                        <x-select wire:model.live='form.parroquia_id' class="flex-grow-1 m-1">
                            <option value="">Parroquia</option>
                            @foreach($parroquias as $key)
                                <option value="{{$key->id}}">{{$key->nombre}}</option>
                            @endforeach
                        </x-select>
                    </div>    
                    <x-input wire:model="form.lugar" type="text" name="lugar" placeholder='Referencia' class='w-full'/>
                    <x-input-error for="form.lugar"/>
                </div>
                
                <x-label class='mt-4'>Sexo</x-label>
                <x-select wire:model="form.sexo" name="sexo" class='w-full form-control'>
                    <option value="" >Seleccione</option>
                    <option value="m">Masculino</option>
                    <option value="f">Femenina</option>
                </x-select>
                <x-input-error for="form.sexo"/>

                <x-label class='mt-4'>Tipo de Estudiante</x-label>
                <x-select wire:model="form.tipo" class='w-full form-control'>
                    <option value="" >Seleccione</option>
                    <option value="Normal">Normal</option>
                    <option value="Especial">Especial</option>
                    <option value="Exonerado">Exonerado</option>
                </x-select>
                <x-input-error for="form.tipo"/>
                
                <x-label class='mt-4'>Institucion de procedencia</x-label>
                <x-input wire:model="form.institucion_procedencia" type="text" placeholder='Institucion de procedencia' class='w-full'/>
                <x-input-error for="form.institucion_procedencia"/>

                <h3 class='border p-2 mt-4 text-center'>Datos Medicos</h3>

                <x-label class='mt-4'>Utilza lentes?</x-label>
                <x-select wire:model="form.lentes" name="lentes" class='w-full form-control'>
                    <option value="" >Seleccione</option>
                    <option value="si">Si</option>
                    <option value="no">No</option>
                </x-select>
                <x-input-error for="form.lentes"/>

                <x-label class='mt-4'>Tratamiento</x-label>
                <x-input wire:model="form.tratamiento" type="text" placeholder='Tratamiento' class='w-full'/>
                <x-input-error for="form.tratamiento"/>

                <x-label class='mt-4'>Vive con:</x-label>
					@foreach($form->opcionesVive as $key)
						<label>
							<input type="checkbox" wire:model='form.selectedVive' value='{{$key}}' >
							{{$key}}
						</label>
					@endforeach
				<x-input-error for="estudianteForm.vive_con"/>
                
                <x-label class='mt-4'>Parto</x-label>
                <x-select wire:model="form.parto" class='w-full form-control'>
                    <option value="" >Seleccione</option>
                    <option value="natural">Natural</option>
                    <option value="cesarea">Cesarea</option>
                </x-select>
                <x-input-error for="form.parto"/>

                <x-label class='mt-4'>Alergias</x-label>
                <x-select wire:model="form.alergias" class='w-full form-control'>
                    <option value="" >Seleccione</option>
                    <option value="asma">Asma</option>
                    <option value="respiratorias">Respiratorias</option>
                    <option value="rinitis">Rinitis</option>
                    <option value="ninguna">Ninguna</option>
                </x-select>
                <x-input-error for="form.alergias"/>
                
                <div class='border p-2 mt-4'>
                    <h3 class='p-1 border text-center'> Datos de la Inscripcion</h3>
                    <x-label class='mt-4'>Nivel Academico</x-label>
                    <x-select wire:model="cursa.nivel_id" name="nivel" class='w-full form-control'>
                        <option value=""  >Seleccione</option>
                        @foreach($nivels as $key)
                            <option value='{{$key->id}}'>{{$key->nombre}}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="cursa.nivel_id"/>
                    
                    <x-label class='mt-4'>Seccion</x-label>
                    <x-select wire:model="cursa.seccion_id" name="seccion" class='w-full form-control'>
                        <option value="" >Seleccione</option>
                        @foreach($seccions as $key)
                            <option value="{{$key->id}}">{{$key->nombre}}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="cursa.seccion_id"/>

                    <x-label class='mt-4'>Año escolar</x-label>
                    <x-select wire:model="cursa.aescolar_id" name="aescolar" class='w-full form-control'>
                        <option value="" >Seleccione</option>
                        @foreach($aescolars as $key)
                            <option value="{{$key->id}}">{{$key->inicio}}-{{$key->final}}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="cursa.aescolar_id"/>

                    <x-label class='mt-4'>Fecha de la Inscripcion</x-label>    
                    <x-input type='date' wire:model="inscripcion.fecha" class='w-full form-control'/>
                        
                    <x-input-error for="inscripcion.fecha"/>
                </div>
            </form> 
        </x-slot>   
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('open',false)" class='mr-2' >
                <i class="fa-solid fa-ban mr-2"></i> 
            Cancelar
            </x-secondary-button>
            <x-button type='submit' form='form-registrar'>
                <span wire:loading wire:target='registrarEstudiante'>
                    <i class='fa-solid fa-rotate fa-spin'></i>
                </span>
                <span wire:loading.remove wire:target="registrarEstudiante">
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