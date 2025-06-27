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
    </div>
    <div>
        <table class="tabla w-full mt-4">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Representante</td>
                    <td>Estudiante</td>
                    <td>Tipo</td>
                    <td>Fecha</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $key)
                    <tr wire:key="item-{{$key->id}}" >
                        <td>{{$key->id}}</td>
                        <td>
                            {{$key->representante->nombre}}
                            {{$key->representante->paterno}}
                        </td>
                        <td>
                            {{$key->estudiante->nombre}}
                            {{$key->estudiante->paterno}}
                        </td>
                        <td>
                            {{$key->tipo}}
                            @if($key->tipo == 'Mensualidad' && $key->mensualidads && $key->mensualidads->count())
                                @foreach($key->mensualidads as $mensualidad)
                                    <div> * {{ $mensualidad->mes }}/{{ $mensualidad->anio }} . {{ $mensualidad->porcentaje }}%</div>
                                @endforeach
                            @endif
                        </td>
                        <td>{{$key->created_at}}</td>
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
                        <td colspan="6" class='text-center'>No hay resultados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>    
    <div class="mt-4">
        {{$items->links()}}
    </div>
    <x-dialog-modal wire:model='open'>
        <x-slot name='title'>
            <h1>{{ empty($form->id) ? 'Registrar Pago' : 'Editar Pago' }}</h1>
        </x-slot>
        <x-slot name='content'>
            <form class="form" id='form-guardar' wire:submit='guardar'>
                <div class='my-2'>
                    <x-button type='button' wire:click='anadirIngreso'>Añadir Ingreso</x-button>

                    <span wire:loading wire:target='anadirIngreso' class='w-full'>
                        <i class='fa-solid fa-rotate fa-spin'></i>
                    </span>
                </div>

                @foreach($ingresos as $i => $ingreso)
                    <div class='border p-2 m-2'>
                        
                        <h3 class='my-2'>Ingreso # {{$i+1}}</h3>    

                        <label for="">Cantidad</label>
                        <x-input type="number" wire:model='ingresos.{{$i}}.cantidad' class="w-full mb-4" placeholder="Cantidad" min='0' step='0.01' required/>
                        <x-input-error for="ingresos.{{$i}}.cantidad"/>

                        <label for="">Tasa del Dolar</label>
                        <x-input type="number" wire:model='ingresos.{{$i}}.dolar' class="w-full mb-4" placeholder="Precio del dolar hoy" min='0' step='0.01' required/>
                        <x-input-error for="ingresos.{{$i}}.dolar"/>

                        <label for="">Fecha <small>(Opcional)</small></label>
                        <x-input type="date" wire:model='ingresos.{{$i}}.fecha' class="w-full mb-4" value='{{date("Y-m-d")}}'/>
                        <x-input-error for="ingresos.{{$i}}.fecha"/>

                        <label for="">Forma de pago</label>
                        <x-select name="" id="" wire:model.live='ingresos.{{$i}}.forma' class="w-full mb-4" required>
                            <option value="">Seleccione</option>
                            <option value="Divisa">Divisa</option>
                            <option value="Transferencia">Transferencia</option>
                            <option value="Efectivo">Efectivo</option>
                        </x-select>
                        <x-input-error for="ingresos.{{$i}}.forma"/>
                        
                        <span wire:loading wire:target='ingresos.{{$i}}.forma' class="mr-2">
                            <i class='fa-solid fa-rotate fa-spin'></i>
                        </span>    

                        @if($ingresos[$i]['forma'] == 'Transferencia')
                            <label for="">Codigo</label>
                            <x-input type="number" wire:model='ingresos.{{$i}}.codigo' class="w-full mb-4" value='' step='1' min='1' required/>
                            <x-input-error for="ingresos.{{$i}}.codigo"/>
                        @endif
                        
                        <label for="">Descripcion <small>(Opcional)</small></label>
                        <x-input type="text" wire:model='ingresos.{{$i}}.descripcion' class="w-full mb-4" placeholder="Descripcion del pago"/>
                        
                        <x-danger-button wire:click='quitarIngreso({{$i}})'>
                            <i class='fa-solid fa-trash'></i>
                        </x-danger-button>
                        
                    </div>

                    <x-input-error for="ingresos.{{$i}}.descripcion"/>

                @endforeach

                <label for="" class='my-2' >Representante</label>
                <x-select name="" id="" wire:model.live='representante_id' class='w-full mb-4'>
                    <option value="">Seleccione un representante</option>
                    @foreach($representantes as $representante)
                        <option value="{{$representante->id}}" {{ $form->representante_id == $representante->id ? 'selected' : '' }}>
                            {{$representante->nombre}} {{$representante->paterno}} {{$representante->cedula}}
                        </option>
                    @endforeach
                </x-select>

                <span wire:loading wire:target='representante_id' class='w-full' >
                    <i class='fa-solid fa-rotate fa-spin'></i>
                </span>

                @foreach($estudiantes as $e => $estudiante)
                        
                    <div class='border p-2 my-2' >
                        <div class='flex' >
                            <p class='my-2'>Estudiante # {{$e+1}} </p>
                            <span class='flex-1 my-2 ml-1'> {{$estudiante["nombre"]}}  {{$estudiante['paterno']}} 
                                <x-input type="checkbox" wire:model='pagos.{{$e}}.seleccionado' value="1" />
                            </span>
                        </div>

                        <label for="" class='my-2'>Seleccione el ingreso</label>

                        <x-select wire:model='pagos.{{$e}}.ingresos' multiple class='w-full' >
                            
                            <option value="">Seleccione</option>
                            
                            @foreach($ingresos as $i=> $ingreso)

                                <option value="{{$i}}"> ingreso # {{$i+1}} {{'Cantidad:'.$ingreso['cantidad'].' - '.$ingreso['forma']}} </option>
                            
                            @endforeach
                        </x-select>

                        <label for="" class='my-2'>Tipo de pago</label>
                        <x-select name="" id="" wire:model.live='pagos.{{$e}}.tipo' class='w-full my-2'>
                            <option value="">Seleccione un tipo</option>
                            <option value="Aranceles">Aranceles</option>
                            <option value="Uniformes">Uniformes</option>
                            <option value="Mensualidad">Mensualidad</option>
                        </x-select>
                        <x-input-error for="pagos.{{$e}}.tipo"/>
                        
                        <label class='my-2'>Exonerado</label> 
                        <x-select wire:model='pagos.{{$e}}.exonerado' required >
                            <option value="">Seleccione</option>
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </x-select>
                        <span wire:loading wire:target='pagos.{{$e}}.tipo' class='w-full'>
                            <i class='fa-solid fa-rotate fa-spin'></i>
                        </span>

                        @if( isset($pagos[$e]) && $pagos[$e]['tipo'] == 'Mensualidad' )

                            <div class='border p-2'>     
                                
                                <x-button type='button' wire:click='anadirMes({{$e}})' class='my-2'> + Añadir Mes </x-button>

                                <span wire:loading wire:target='anadirMes' class='w-full'>
                                    <i class='fa-solid fa-rotate fa-spin'></i>
                                </span>
                                <span wire:loading wire:target='quitarMes' class='w-full'>
                                    <i class='fa-solid fas-rotate fa-spin'></i>
                                </span>
                                
                                @foreach($pagos[$e]['meses'] as $j => $mensualidad)
                                    
                                    <label for="" class='my-2 w-full' >Mes # {{$j+1}} </label>    
                                    <x-select name="" id="" wire:model.live="pagos.{{$e}}.meses.{{$j}}.mes" class='w-full my-2'>
                                        <option value="">Seleccione un mes</option>
                                        <option value="Enero">Enero</option>
                                        <option value="Febrero">Febrero</option>
                                        <option value="Marzo">Marzo</option>
                                        <option value="Abril">Abril</option>
                                        <option value="Mayo">Mayo</option>
                                        <option value="Junio">Junio</option>
                                        <option value="Julio">Julio</option>
                                        <option value="Agosto">Agosto</option>
                                        <option value="Septiembre">Septiembre</option>
                                        <option value="Octubre">Octubre</option>
                                        <option value="Noviembre">Noviembre</option>
                                        <option value="Diciembre">Diciembre</option>
                                    </x-select>  
                                    <label for="" class='my-2 w-full'>Año</label>
                                    <x-input type="number" wire:model='pagos.{{$e}}.meses.{{$j}}.anio' step='1' min='2000' max='3000' class='w-full my-2' value='{{date("Y")}}'  />
                                    <label for="" class='my-2 w-full'>Porcentaje</label>
                                    <x-input type="number" wire:model='pagos.{{$e}}.meses.{{$j}}.porcentaje' step='10' min='10' max='100' class='w-full my-2' value='100'/>
                                    <label for="" class='my-2 w-full'>
                                        Mensualidad Exonerada
                                        <x-select wire:model='pagos.{{$e}}.meses.{{$j}}.exonerado' required>
                                            <option value="">Seleccione</option>
                                            <option value="si">Si</option>
                                            <option value="no">No</option>
                                        </x-select>
                                    </label>
                                    <x-danger-button wire:click='quitarMes({{$e}})'>
                                        <i class='fa-solid fa-trash'></i>
                                    </x-danger-button>    
                                @endforeach
                            </div>
                        @endif                         
                    </div>  
                @endforeach                
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
                Registrar</span>
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model='openEditar'>
        <x-slot name='title'>
            <h1>Editar Pago</h1>
        </x-slot>
        <x-slot name='content'>
            <form id='form-editar' wire:submit='actualizar' >
                @if(isset($pago->representante))    
                    <p class='my-2'>Representante: {{ $pago->representante->nombre }} {{ $pago->representante->paterno }} </p>
                    <p class='my-2'>Estudiante: {{ $pago->estudiante->nombre }} {{ $pago->estudiante->paterno }}</p>
                    <p class='my-2'>tipo: {{ $pago->tipo }}</p>
                    <p class='my-2'>Exonerado: {{ $pago->exonerado }}</p>
                @endif
            </form>    
            <p class='my-2'>Lista de ingresos de este pago:</p>
            @foreach($ingresosEditar as $i=>$ingreso)
                <div class='alert-success flex  border p-2 rounded my-2'>
                    <div class='flex-1'>
                        <p>ID: {{$ingreso->id}} </p>
                        <p>Cantidad: {{$ingreso->cantidad}} </p>
                        <p>dolar: {{$ingreso->dolar}} </p>
                        <p>forma: {{$ingreso->forma}} </p>
                        <p>fecha: {{$ingreso->fecha}} </p>
                    </div>  
                    <div>   
                        <span wire:click='borrarIngreso({{$ingreso->id}})' class='cursor-pointer'>
                            <i class="fa-solid fa-xmark"></i>
                        </span>
                    </div>       
                </div>            
            @endforeach
            <p class='my-2'>Añadir Ingreso a este pago</p>
            <div class='border p-2'>
                <form action="" wire:submit='asignarIngreso'>
                    <label for="">Cantidad</label>
                    <x-input type="number" wire:model='ingresoEditar.cantidad' class="w-full mb-4" placeholder="Cantidad" min='0' step='0.01' required/>
                    <x-input-error for="ingresoEditar.cantidad"/>

                    <label for="">Tasa del Dolar</label>
                    <x-input type="number" wire:model='ingresoEditar.dolar' class="w-full mb-4" placeholder="Precio del dolar hoy" min='0' step='0.01' required/>
                    <x-input-error for="ingresoEditar.dolar"/>

                    <label for="">Fecha <small>(Opcional)</small></label>
                    <x-input type="date" wire:model='ingresoEditar.fecha' class="w-full mb-4" value='{{date("Y-m-d")}}'/>
                    <x-input-error for="ingresoEditar.fecha"/>

                    <label for="">Forma de pago</label>
                    <x-select name="" id="" wire:model.live='ingresoEditar.forma' class="w-full mb-4" required>
                        <option value="">Seleccione</option>
                        <option value="Divisa">Divisa</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Efectivo">Efectivo</option>
                    </x-select>
                    <x-input-error for="ingresoEditar.forma"/>
                    
                    <span wire:loading wire:target='ingresoEditar.forma' class="mr-2">
                        <i class='fa-solid fa-rotate fa-spin'></i>
                    </span>    

                    @if($ingresoEditar->forma == 'Transferencia')
                        <label for="">Codigo</label>
                        <x-input type="number" wire:model='ingresoEditar.codigo' class="w-full mb-4" value='' step='1' min='1' required/>
                        <x-input-error for="ingresoEditar.codigo"/>
                    @endif
                    
                    <label for="">Descripcion <small>(Opcional)</small></label>
                    <x-input type="text" wire:model='ingresoEditar.descripcion' class="w-full mb-4" placeholder="Descripcion del pago"/>
                         
                    <x-button type='submit'>
                        <span wire:loading wire:target='asignarIngreso'>
                        <i class='fa-solid fa-rotate fa-spin'></i>
                        </span>
                        <span wire:loading.remove wire:target='asignarIngreso'>
                            <i class="fa-solid fa-plus mr-2"></i> 
                            Añadir
                        </span>
                    </x-button>
                </form>            
            </div>

            <p class='my-2'>Lista de mensualidades de este pago:</p>
            
            @foreach($mensualidadesEditar as $m=>$mensualidad)
                <div class='alert-success flex  border p-2 rounded my-2'>
                    <div class='flex-1'>
                        <p>Mes: {{$mensualidad->mes}} </p>
                        <p>Año: {{$mensualidad->anio}} </p>
                        <p>Porcentaje: {{$mensualidad->porcentaje}}% </p>
                        <p>Exonerado: {{$mensualidad->exonerado}} </p>
                        <p>Fecha: {{$mensualidad->created_at}} </p>
                    </div>  
                    <div>   
                        <span wire:click='borrarMensualidad({{$mensualidad->id}})' class='cursor-pointer'>
                            <i class="fa-solid fa-xmark"></i>
                        </span>
                    </div>       
                </div>            
            @endforeach

            <p class='my-2'>Añadir Mensualidad a este pago</p>
            <div class='border p-2 my-2'>
                <form action="" wire:submit='asignarMensualidad'>
                    <label for="" class='my-2 w-full'>Mes</label>
                    <x-select name="" id="" wire:model='mensualidadEditar.mes' class='w-full' required>
                        <option value="">Seleccione</option>
                        <option value="Enero">Enero</option>
                        <option value="Febrero">Febrero</option>
                        <option value="Marzo">Marzo</option>
                        <option value="Abril">Abril</option>
                        <option value="Mayo">Mayo</option>
                        <option value="Junio">Junio</option>
                        <option value="Julio">Julio</option>
                        <option value="Agosto">Agosto</option>
                        <option value="Septiembre">Septiembre</option>
                        <option value="Octubre">Octubre</option>
                        <option value="Noviembre">Noviembre</option>
                        <option value="Diciembre">Diciembre</option>    
                    </x-select>        
                    <label for="" class='my-2 w-full'>Año</label>        
                    <x-input type="number" wire:model='mensualidadEditar.anio' step='1' min='2000' required class='w-full' /> 
                    <label for="" class='my-2 w-full'>Porcentaje</label>
                    <x-input type="number" wire:model='mensualidadEditar.porcentaje' step='10' min='10' max='100' required class='w-full'/> 
                    <label for="" class='my-2 w-full'>Exonerado
                        <x-select wire:model='mensualidadEditar.exonerado' required>
                            <option value="">Seleccione</option>
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </x-select>
                    </label>
                    <x-button type='submit' class='my-2'>
                        <span wire:loading wire:target='asignarMensualidad'>
                        <i class='fa-solid fa-rotate fa-spin'></i>
                        </span>
                        <span wire:loading.remove wire:target='asignarMensualidad'>
                            <i class="fa-solid fa-plus mr-2"></i> 
                            Añadir
                        </span>
                    </x-button>
                </form>            
            </div>
            
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('openEditar',false)" class='mr-2' wire:loading.remove wire:target='actualizar' >
                <i class="fa-solid fa-ban mr-2"></i> 
                Cancelar
            </x-secondary-button>
            <x-button type='submit' form='form-editar'>
                <span wire:loading wire:target='actualizar'>
                    <i class='fa-solid fa-rotate fa-spin'></i>
                </span>
                <span wire:loading.remove wire:target='actualizar'>
                    <i class="fa-solid fa-plus mr-2"></i> 
                    Actualizar
                </span>
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
                <span wire:loading wire:target='eliminar'>
                    <i class='fa-solid fa-rotate fa-spin'></i>
                </span>
                <span wire:loading.remove wire:target='eliminar'>
                    <i class="fa-solid fa-trash mr-2"></i> 
                    Eliminar
                </span>
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model='openEliminarIngreso'>
        <x-slot name='title'>
            <h1>Eliminar Ingreso</h1>
        </x-slot>
        <x-slot name='content'>
            <form id='form-eliminar-ingreso' wire:submit='eliminarIngreso' >
                <h3>Seguro de eliminar ?</h3>
            </form>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('openEliminarIngreso',false)" class='mr-2' wire:loading.remove wire:target='eliminar' >
                <i class="fa-solid fa-ban mr-2"></i> 
                Cancelar
            </x-secondary-button>
            <x-danger-button type='submit' form='form-eliminar-ingreso'>
                <span wire:loading wire:target='eliminarIngreso'>
                    <i class='fa-solid fa-rotate fa-spin'></i>
                </span>
                <span wire:loading.remove wire:target='eliminarIngreso'>
                    <i class="fa-solid fa-trash mr-2"></i> 
                    Eliminar
                </span>
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model='openEliminarMensualidad'>
        <x-slot name='title'>
            <h1>Eliminar Mensualidad</h1>
        </x-slot>
        <x-slot name='content'>
            <form id='form-eliminar-mensualidad' wire:submit='eliminarMensualidad' >
                <h3>Seguro de eliminar ?</h3>
            </form>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('openEliminarIngreso',false)" class='mr-2' wire:loading.remove wire:target='eliminar' >
                <i class="fa-solid fa-ban mr-2"></i> 
                Cancelar
            </x-secondary-button>
            <x-danger-button type='submit' form='form-eliminar-mensualidad'>
                <span wire:loading wire:target='eliminarMensualidad'>
                    <i class='fa-solid fa-rotate fa-spin'></i>
                </span>
                <span wire:loading.remove wire:target='eliminarMensualidad'>
                    <i class="fa-solid fa-trash mr-2"></i> 
                    Eliminar
                </span>
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

    @section('scripts')

    @endsection

</div>