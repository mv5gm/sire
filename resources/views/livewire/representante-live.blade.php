<div>       
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="flex ">
        <x-input class="w-full mr-4" type="text" wire:model.live="buscar" name="" placeholder="Buscar..."/>
        <a>
            <x-button wire:click="registrar">
                <span wire:loading.remove wire:target='registrar' class='flex'>
                    Registrar
                </span>
                <span wire:loading wire:target='registrar'>
                    <i class="fa-solid fa-rotate fa-spin"></i>
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
                    <td>Estudiantes</td>
                    <td width="250">Opciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $key)
                    <tr wire:key="item-{{$key->id}}" >
                        <td>{{$key->cedula}}</td>
                        <td>{{$key->nombre}} {{$key->segundo}} {{$key->paterno}} {{$key->materno}}</td>
                        <td>{{ count( $key->representados ) }}</td>
                        <td width="250">
                            <x-button wire:click="editar({{$key->id}})" >
                                <span wire:loading.remove wire:target='editar'>
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </span>    
                                <span wire:loading wire:target='editar'>
                                    <i class='fa-solid fa-rotate fa-spin'></i>
                                </span>
                            </x-button>
                            <x-button wire:click="representadoVer({{$key->id}})" >
                                <span wire:loading.remove wire:target='representadoVer'>
                                    <i class="fa-solid fa-user-tie" ></i>
                                </span>
                                <span wire:loading wire:target='representadoVer' >
                                    <i class='fa-solid fa-rotate fa-spin'></i>
                                </span>    
                            </x-button>
                            <x-danger-button wire:click="borrar({{$key->id}})">
                                <span wire:loading.remove wire:target='borrar'>    
                                    <i class="fa-solid fa-trash"></i>
                                </span>
                                <span wire:loading wire:target='borrar'>
                                    <i class='fa-solid fa-rotate fa-spin'></i>
                                </span>    
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
                <h1>Registrar</h1>
            @else   
                <h1>Editar</h1>
            @endif

        </x-slot>
        <x-slot name='content'>
            <form class="form" id='form-guardar' wire:submit='guardar' >
                <x-label>Cedula</x-label>
                <x-input wire:model='form.cedula' type="text" placeholder='Cedula' class='w-full'/>
                <x-input-error for="form.cedula"/>

                <x-label class='mt-4'>Primer Nombre</x-label>
                <x-input wire:model="form.nombre" type="text" placeholder='Primer Nombre' class='w-full' />
                <x-input-error for="form.nombre"/>

                <x-label class='mt-4'>Segundo Nombre <small>(Opcional)</small></x-label>
                <x-input wire:model="form.segundo" type="text" placeholder='Segundo Nombre' class='w-full'/>
                <x-input-error for="form.segundo"/>

                <x-label class='mt-4'>Primer Apellido</x-label>
                <x-input wire:model="form.paterno" type="text" placeholder='Primer Apellido' class='w-full'/>
                <x-input-error for="form.paterno"/>

                <x-label class='mt-4'>Segundo Apellido <small>(Opcional)</small></x-label>
                <x-input wire:model="form.materno" type="text" placeholder='Segundo Apellido' class='w-full'/>
                <x-input-error for="form.materno"/>
                
                <x-label class='mt-4'>Estado Civil</x-label>
                <x-select wire:model="form.estado_civil" class='w-full' >
                    <option value="">Seleccione</option>
                    <option value="Soltero(a)">Soltero(a)</option>
                    <option value="Casado(a)">Casado(a)</option>
                    <option value="Divorciado(a)">Divorciado(a)</option>
                    <option value="Viudo(a)">Viudo(a)</option>
                    <option value="Concubinato">Concubinato</option>
                </x-select>  
                <x-input-error for="form.estado_civil"/>

                <x-label class='mt-4'>Condicion Laboral</x-label>
                <x-select wire:model="form.condicion_laboral" class='w-full' >
                    <option value="">Seleccione</option>
                    <option value="Empleado(a)">Empleado(a)</option>
                    <option value="Desempleado(a)">Desempleado(a)</option>
                </x-select>  
                <x-input-error for="form.condicion_laboral"/>

                <x-label class='mt-4'>Oficio</x-label>
                <x-input wire:model="form.oficio" type="text" placeholder='Oficio' class='w-full'/>
                <x-input-error for="form.oficio"/>

                <x-label class='mt-4'>Direccion de Habiacion</x-label>
                <x-input wire:model="form.direccion_habitacion" type="text" placeholder='Direccion' class='w-full'/>
                <x-input-error for="form.direccion_habitacion"/>

                <x-label class='mt-4'>Direccion de Trabajo <small>(Opcional)</small></x-label>
                <x-input wire:model="form.direccion_trabajo" type="text" placeholder='Direccion' class='w-full'/>
                <x-input-error for="form.direccion_trabajo"/>

                <x-label class='mt-4'>Lugar de Nacimiento</x-label>
                <x-input wire:model="form.lugar_nacimiento" type="text" placeholder='Lugar' class='w-full'/>
                <x-input-error for="form.lugar_nacimiento"/>

                <x-label class='mt-4'>Fecha de Nacimiento</x-label>
                <x-input wire:model="form.fecha" type="date" class='w-full'/>
                <x-input-error for="form.fecha"/>

                <x-label class='mt-4'>Telefono Fijo <small>(Opcional)</small></x-label>
                <x-input wire:model="form.telefono" type="text" placeholder='Solo los numeros' class='w-full'/>
                <x-input-error for="form.telefono"/>
                
                <x-label class='mt-4'>Telefono Movil <small>(Opcional)</small></x-label>
                <x-input wire:model="form.telefono_movil" type="text" placeholder='Solo los numeros' class='w-full'/>
                <x-input-error for="form.telefono_movil"/>

                <x-label class='mt-4'>Nivel Academico</x-label>
                <x-select wire:model="form.nivel_academico" class='w-full' >
                    <option value="">Seleccione</option>
                    <option value="ninguna">ninguno</option>
                    <option value="primaria">primaria</option>
                    <option value="secundaria">secundaria</option>
                    <option value="universitario">universitario</option>
                </x-select>  
                <x-input-error for="form.nivel_academico"/>

                <x-label class='mt-4'>Nivel de Ingreso <small>(Opcional)</small></x-label>
                <x-input wire:model="form.nivel_ingreso" type="text" placeholder='Cantidad de Dinero o sueldo minimo o mayor' class='w-full'/>
                <x-input-error for="form.nivel_ingreso"/>

                <x-label class='mt-4'>Correo <small>(Opcional)</small></x-label>
                <x-input wire:model="form.email" type="text" placeholder='Telefono' class='w-full'/>
                <x-input-error for="form.email"/>
            </form>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('open',false)" class='mr-2' >
                <i class="fa-solid fa-ban mr-2"></i> 
            Cancelar
            </x-secondary-button>
            <x-button type='submit' form='form-guardar' >
                <span wire:loading wire:target='guardar'>
                    <i class='fa-solid fa-rotate fa-spin'></i>
                </span>
                <span wire:loading.remove wire:target='guardar'>
                    <i class="fa-solid fa-plus mr-2"></i> 
                @if(empty($form->id))
                    Registrar
                @else   
                    Editar
                @endif
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

    <x-dialog-modal wire:model='openRepresentado'>
        <x-slot name='title'>
            <h1>Estudiantes del Representante</h1>
        </x-slot>
        <x-slot name='content'>
            
            @if($asignarEstudiante)
                <div class='p-2 relative'>
                    <a wire:click="$set('asignarEstudiante',false)" class="absolute top-0 right-0">
                        <i class="fa-solid fa-times"></i>
                    </a>
                </div>
                <form id='form-representando' wire:submit='representadoGuardar' >
                    
                    <label class='p-2'>Selecione un estudiante</label>
                    <x-select wire:model="representado.estudiante_id" class='w-full'>
                        <option value="" selected> Seleccione </option>
                        @foreach($estudiantes as $key)
                            <option value="{{$key->id}}">{{$key->cedula.' '.$key->nombre.' '.$key->paterno}}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="representado.estudiante_id"/>    
                    
                    <label class='p-2'>Relacion</label>
                    <x-select wire:model='representado.relacion' class='w-full'>
                        <option value=''>Seleccione</option>
                        <option value='Legal'>Tutor Legal</option>
                        <option value='Autorizado'>Autorizado</option>
                    </x-select>
                    <x-input-error for="representado.relacion"/>

                    <label class='p-2'>Parentesco</label>
                    <x-select wire:model='representado.parentesco' class='w-full'>
                        <option value=''>Seleccione</option>
                        <option value='Padre'>Padre</option>
                        <option value='Madre'>Madre</option>
                        <option value='Abuelo(a)'>Abuelo(a)</option>
                        <option value='Tio(a)'>Tio(a)</option>
                        <option value='Hermano(a)'>Hermano(a)</option>
                        <option value='Primo(a)'>Primo(a)</option>
                        <option value='Otro(a)'>Otro(a)</option>
                    </x-select>
                    <x-input-error for="representado.parentesco"/>

                    <h3 class='py-2'>Datos del Hogar</h3>
                    
                    <label class='p-2'>
                        <x-input type="checkbox" wire:model.live='hogarRegistrado'/>
                        Hogar Registrado
                    </label>

                    @if(!$hogarRegistrado)
                        <div class='p-2 border '>
                            <label class='p-2'>Numero de Mayores</label>
                            <x-input type="number" step='1' min='1' wire:model='hogar.numero_mayores' placeholder='Numero de Adultos del hogar' class='w-full'/>    
                            <x-input-error for="hogar.numero_mayores"/>

                            <label class='p-2'>Numero de Menores</label>
                            <x-input type="number" step='1' min='1' wire:model='hogar.numero_menores' placeholder='Numero de menores de edad del hogar' class='w-full'/>    
                            <x-input-error for="hogar.numero_menores"/>

                            <label class='p-2'>Numero de familias</label>
                            <x-input type="number" step='1' min='1' wire:model='hogar.numero_familias' placeholder='Numero de familias del hogar' class='w-full'/>    
                            <x-input-error for="hogar.numero_familias"/>

                            <label class='p-2'>Numero de ambientes</label>
                            <x-input type="number" step='1' min='1' wire:model='hogar.numero_ambitos' placeholder='Numero de ambientes del hogar' class='w-full'/>    
                            <x-input-error for="hogar.numero_ambitos"/>

                            <label class='p-2'>Representante Economico</label>
                            <x-select wire:model='hogar.representante_economico' class='w-full'>
                                <option value=''>Seleccione</option>
                                <option value='Padre'>Padre</option>
                                <option value='Madre'>Madre</option>
                                <option value='Ambos'>Ambos</option>
                                <option value='Otro'>Otro</option>
                            </x-select>
                            <x-input-error for="hogar.representante_economico"/>

                            <label class='p-2'>Gastos Separados</label>
                            <x-select wire:model='hogar.gastos_separados' class='w-full'>
                                <option value=''>Seleccione</option>
                                <option value='si'>Sí</option>
                                <option value='no'>No</option>
                            </x-select>
                            <x-input-error for="hogar.gastos_separados"/>

                            <label class='p-2'>Numero de dormitorios</label>
                            <x-input type="number" step='1' min='1' wire:model='hogar.numero_dormitorios' placeholder='Numero de Dormitorios' class='w-full'/>    
                            <x-input-error for="hogar.numero_dormitorios"/>

                            <label class='p-2'>Telefono de emergencia</label>
                            <x-input type="text" wire:model='hogar.telefono_emergencia' placeholder='Telefono de emergencia' class='w-full'/>    
                            <x-input-error for="hogar.telefono_emergencia"/>
                        </div>
                    @else
                        <x-select wire:model='hogar_id' class='w-full my-2'>
                            <option value="">Seleccione</option>
                            
                            @foreach($hogars as $hogar)
                                <option value="{{$hogar['id'] }}" >
                                     {{$hogar['cedula'].' - '.$hogar['nombre'].' '.$hogar['paterno']}}  
                                </option>
                            @endforeach
                        </x-select>        
                    @endif
                    
                    <div >
                        <x-button>Asignar</x-button>
                    </div>
                </form>    
            @else
                <x-button wire:click="$set('asignarEstudiante',true)" >Asignar Estudiante</x-button>
            @endif
            <div class="mt-4">
                @foreach($estudiantes_representados as $key)
                    <div class="alert alert-success" role="alert">
                      
                      <strong>{{ $key->cedula }} </strong> {{$key->nombre}} {{$key->paterno}}

                      (relacion: tutor {{$key->relacion}} )
                      
                      <button wire:click='borrarRepresentado({{$key->id}})' type="button" class="btn-close" aria-label="Close"></button>
                    </div>
                @endforeach
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('openEstudiante',false)" class='mr-2' wire:loading.remove wire:target='representanteAsignar' >
                <i class="fa-solid fa-ban mr-2"></i> 
                Cerrar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model='openEliminarRepresentado'>
        <x-slot name='title'>
            <h1>Desvincular representante</h1>
        </x-slot>
        <x-slot name='content'>
            <form id='form-eliminar-representado' wire:submit='eliminarRepresentado' >
                <h3>Seguro de desvincular ?</h3>
            </form>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('openEliminarRepresentado',false)" class='mr-2' wire:loading.remove wire:target='eliminarRep' >
                <i class="fa-solid fa-ban mr-2"></i> 
                Cancelar
            </x-secondary-button>
            <x-danger-button type='submit' form='form-eliminar-representado'>
                <span wire:loading wire:target='eliminarRepresentado'>Cargando...</span>
                <span wire:loading.remove wire:target='eliminarRepresentado'>
                    <i class="fa-solid fa-trash mr-2"></i> 
                    Desvincular
                </span>
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>