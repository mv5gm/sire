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
                    <td>Cantidad</td>
                    <td>Forma</td>
                    <td>Fecha</td>
                    <td>Tipo</td>
                    <td>Estudiantes</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $key)
                    <tr wire:key="item-{{$key->id}}" >
                        <td>{{$key->id}}</td>
                        <td>{{$key->ingreso->cantidad}}</td>
                        <td>{{$key->ingreso->forma}}</td>
                        <td>{{$key->ingreso->fecha}}</td >
                        <td>{{$key->tipo}}</td>
                        <td>{{$key->estudiantes}}</td>
                        <td>
                            <x-button wire:click="editar({{$key->ingreso->id}})" >
                              <i class="fa-solid fa-pen-to-square"></i>
                            </x-button>
                            <x-danger-button wire:click="borrar({{$key->ingreso->id}})">
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
                
                <x-label class='mt-4'>Cantidad</x-label>
                <x-input wire:model="ingreso.cantidad" type="number" step='0.1' min='0.1' placeholder='Cantidad de Dinero' class='w-full' autocomplete="off" />
                <x-input-error for="ingreso.cantidad"/>    

                <x-label class='mt-4'>Forma de Pago</x-label>
                <x-select wire:model.live="ingreso.forma" name="forma" class='w-full form-control'>
                    <option value=""  >Seleccione</option>
                    <option value='Efectivo'>Efectivo</option>
                    <option value='Transferencia'>Transferencia</option>
                    <option value='Divisa'>Divisa</option>
                </x-select>
                <x-input-error for="ingreso.forma"/>    
                
                <span wire:loading wire:target="ingreso.forma">
                    <i class='fa-solid fa-rotate fa-spin'></i>
                </span>

                @if( $ingreso->forma == 'Transferencia' )

                    <div>
                        <x-label class='mt-4'>Codigo</x-label>
                        <x-input wire:model="ingreso.codigo" type="text" minlength='4' maxlength='4' placeholder='Codigo de la transferencia' class='w-full' autocomplete="off" />
                        <x-input-error for="ingreso.codigo"/>
                    </div>
                    
                @endif

                <x-label class='mt-4'>Precio del dolar</x-label>
                <x-input wire:model="ingreso.dolar" type="number" step='0.1' min='0.1' placeholder='cantidad de Bolivares' class='w-full' autocomplete="off" />
                <x-input-error for="ingreso.dolar"/>
                
                <x-label class='mt-4'>Fecha (Opcional)</x-label>
                <x-input wire:model="ingreso.fecha" type="date" class='w-full'/>
                <x-input-error for="ingreso.fecha"/> 

                <x-label class='mt-4'>Descripcion (Opcional)</x-label>
                <x-input wire:model="ingreso.descripcion" type="text" placeholder='Descripcion' class='w-full'/>
                <x-input-error for="ingreso.descripcion"/>

                <x-label class='mt-4'>Representante</x-label>
                
                <x-select wire:model.live='form.representante_id' name="id" class="w-full" id='repre_id_reg' >
                    
                    <option value="">Seleccione</option>
                    
                    @forelse($representantes as $key)
                        
                        <option value="{{$key->id}}">{{$key->cedula.'-'.$key->nombre.' '.$key->paterno}}</option>    
                    
                    @empty    

                    @endforelse

                </x-select>
                <x-input-error for="form.representante_id"/>
                
                <span wire:loading wire:target='form.representante_id'>
                    <i class='fa-solid fa-rotate fa-spin'></i>
                </span>

                @if($estudiantes->count())
                    
                    <x-label class='mt-4'>Estudiante</x-label>
                    
                    @forelse($estudiantes as $key)  
                        
                        <label> 
                            <input type="checkbox" wire:model="estudiantesSeleccionados" value="{{$key->id}}" name='estudiantes'>
                            {{$key->nombre.' '.$key->paterno}}
                        </label>
                    @empty

                    @endforelse

                @endif

                <x-input-error for="form.estudiante_id"/>

                <x-label class='mt-4'>Tipo de pago</x-label>
                <x-select wire:model.live="form.tipo" name="forma" class='w-full form-control'>
                    <option value="" >Seleccione</option>
                    <option value='Aranceles'>Aranceles</option>
                    <option value='Uniformes'>Uniformes</option>
                    <option value='Mensualidad'>Mensualidad</option>
                </x-select>
                <x-input-error for="form.tipo"/>
                        
                @if( $form->tipo == 'Mensualidad' )
                    
                    @foreach (range(date('Y'), date('Y') + 1) as $anio)
                        <p class='py-2'> {{$anio}} </p>
                        @foreach(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $mes)
                            <label for=""> {{$mes}} </label>
                            <input type="checkbox" wire:model='mesesSeleccionados' value="{{$mes.'-'.$anio}}" class='m-2'/>
                        
                        @endforeach
                        <br>
                        <hr>

                    @endforeach

                @endif
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