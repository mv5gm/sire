<div>       
    
    @php
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    @endphp

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
            <x-button wire:click="mostrarNomina">
                <span wire:loading wire:target='mostrarNomina'>
                    <i class='fa-solid fa-rotate fa-spin'></i>
                </span>
                <span wire:loading.remove wire:target='mostrarNomina'>    
                    <i class="fa-solid fa-money-bill"></i><i class="fa-solid fa-user "></i> Nomina
                </span>
            </x-button>
        </a>
    </div>
    
    @if( $openNomina )
        <div class='m-4 border border-gray-300 rounded-lg shadow-lg bg-white'>
            <div class='flex'>
                <h1 class='text-center p-4 flex-1'>Pagar Nomina</h1>
                <button wire:click='$set("openNomina",false)'><i class='fa-solid fa-xmark p-4'></i></button>
            </div>
            <div class='p-4'>
                <form id='form-nomina' wire:submit='guardarNomina' >
                    <div class='flex flex-wrap'>
                        <div class='flex p-2'>
                            <label for="">
                                Precio Del Dolar
                                <x-input wire:model.live='dolar' type='number' step='0.01' min='1' placeholder='Precio del Dolar' class='w-full' /> 
                            </label>
                        </div>
                        <div class='flex p-2'>
                            <label for="">
                                Precio de la hora academica
                                <x-input wire:model.live='horas' type='number' step='0.01' min='1' placeholder='Precio de la hora academica' class='w-full' /> 
                            </label>
                        </div>
                        <div class='flex p-2'>
                            <label for="">
                                Precio por Estudiante
                                <x-input wire:model.live='matricula' type='number' step='0.01' min='1' placeholder='Cantidad de Estudiantes' class='w-full' /> 
                            </label>
                        </div>
                        <div class='flex p-2'>
                            <label for="">Tipo de Nomina
                                <x-select wire:model.live='tipo' class='w-full'>
                                    <option value="Mensual">Tipo de Nomina</option>
                                    <option value="Mensual">Mensual</option>
                                    <option value="Quincenal">Quincenal</option>
                                </x-select>
                            </label>
                        </div>
                            
                        @if( $tipo == '2' )
                            <div class='flex p-2'>
                                <label for="">Quincena
                                    <x-select wire:model.live='quincena' class='w-full'>
                                        <option value="Primera">Quincena de Nomina</option>
                                        <option value="Primera">Primera</option>
                                        <option value="Segunda">Segunda</option>
                                    </x-select>
                                </label>
                            </div>
                        @endif

                        <div class='flex p-2'>
                            <label for="">Mes
                                <x-select wire:model='mes' class='w-full'>
                                    <option value="">Seleccione un Mes</option>
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </x-select>
                            </label>
                        </div>
                        <div class='flex p-2'>
                            <label for="">Año
                                <x-input wire:model.live='anio' type='number' step='1' min='2000' placeholder='Año' class='w-full' /> 
                            </label>            
                        </div>
                    </div>
                    <table class='w-full mt-4'>
                        <thead>
                            <tr>
                                <td>Cedula</td>
                                <td>Nombre y Apellido</td>
                                <td>Datos</td>
                                <td>Cantidad en Bs</td>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach($empleados as $key)
                        <tr>
                            <td> {{$key->cedula}} </td>    
                            <td> {{$key->nombre.' '.$key->paterno}} </td>
                            <td> 
                            
                            @if($key->tipo == 'Docente')
                                {{$key->horas}} (Horas)
                            @elseif($key->tipo == 'Maestro')
                                {{$key->matricula}} (Estudiantes)
                            @else    
                                {{$key->sueldo}}
                            @endif

                            </td>
                            <td><x-input type="number" min='1' step='0.01' wire:model.defer="cantidades.{{$key->id}}" class='w-full' /> </td>
                        </tr>
                    @endforeach
                        </tbody>
                    </table>    
                </form>
            </div>
            <div class='bg-light p-4 border rounded-lg'>
                <x-secondary-button wire:click="$set('openNomina',false)" class='mr-2' wire:loading.remove wire:target='guardarNomina' >
                    <i class="fa-solid fa-ban mr-2"></i> 
                    Cancelar
                </x-secondary-button>
                <x-button type='submit' form='form-nomina'>
                    <span wire:loading wire:target='guardarNomina'>
                        <i class='fa-solid fa-rotate fa-spin'></i>
                    </span>
                    <span wire:loading.remove wire:target='guardarNomina'>
                        <i class="fa-solid fa-money-bill mr-2"></i> 
                        Guardar
                    </span>
                </x-button>
            </div>
        </div>
    @endif

    <div>
        <table class="tabla w-full mt-4">
            <thead>
                <tr>
                    <td>Cantidad</td>
                    <td>Nombre Completo</td>
                    <td>Forma de Pago</td>
                    <td>Tipo de Nomina</td>
                    <td>mes / año</td>
                    <td width='100px' class='flex'>Opciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $key)
                    <tr wire:key="item-{{$key->id}}" >
                        <td>{{$key->cantidad}}</td>
                        <td>{{$key->empleado->nombre}} {{$key->empleado->segundo}} {{$key->empleado->paterno}} {{$key->empleado->materno}}</td>
                        <td>{{$key->forma}}</td>
                        <td>{{$key->tipo}}</td>
                        <td>{{$meses[$key->mes-1]}} / {{$key->anio}} </td>
                                                
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
                <h1>Registrar Nómina</h1>
            @else
                <h1>Editar Nómina</h1>
            @endif
        </x-slot>
        <x-slot name='content'>
            <form class="form" id='form-registrar' wire:submit.prevent='guardar'>
                
                <x-label>Cantidad</x-label>
                <x-input type='number' wire:model='form.cantidad' name="id" class="w-full" placeholder='Cantidad'/>
                <x-input-error for="form.cantidad"/>

                <x-label class='mt-4'>Empleado</x-label>
                <x-select wire:model='form.empleado_id'>
                    <option value="">Seleccione un empleado</option>
                    @foreach($empleados as $key)
                        <option value="{{$key->id}}">{{$key->nombre.' '.$key->paterno}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.empleado_id"/>

                <x-label class='mt-4'>Mes</x-label>
                <x-select wire:model='form.mes'>
                    <option value="">Seleccione un Mes</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </x-select>    
                <x-input-error for="form.mes"/>

                <x-label class='mt-4'>Año</x-label>
                <x-input type='number' wire:model='form.anio' class="w-full" placeholder='Año'/>
                <x-input-error for="form.anio"/>

                <x-label class='mt-4'>Tipo de Nómina</x-label>
                <x-select wire:model.live='form.tipo'>
                    <option value="">Seleccione</option>
                    <option value="Quincenal">Quincenal</option>
                    <option value="Mensual">Mensual</option>
                </x-select>
                <x-input-error for="form.tipo"/>

                @if($form->tipo == 'Quincenal')
                    <x-label class='mt-4'>Tipo de Quincena</x-label>
                    <x-select wire:model.live='form.quincena'>
                        <option value="">Seleccione</option>
                        <option value="Primera">Primera</option>
                        <option value="Segunda">Segunda</option>
                    </x-select>
                    <x-input-error for="form.quincena"/>
                @endif

                <x-label class='mt-4'>Forma de Pago</x-label>
                <x-select wire:model.live="form.forma" class='w-full form-control'>
                    <option value="">Seleccione</option>
                    <option value='Divisa'>Divisa</option>
                    <option value='Transferencia'>Transferencia</option>
                    <option value='Efectivo'>Efectivo</option>
                </x-select>
                <x-input-error for="form.forma"/>
                
            </form>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('open',false)" class='mr-2'>
                <i class="fa-solid fa-ban mr-2"></i> 
                Cancelar
            </x-secondary-button>
            <x-button type='submit' form='form-registrar'>
                <span wire:loading wire:target='guardar'><i class='fa-solid fa-rotate fa-spin'></i></span>
                <span wire:loading.remove wire:target='guardar'>Guardar</span>
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