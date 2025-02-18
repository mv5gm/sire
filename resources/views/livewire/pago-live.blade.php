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
                    <td>ID</td>
                    <td>Cantidad ($)</td>
                    <td>Cantidad (Bs)</td>
                    <td>Fecha</td>
                    <td>Tipo</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $key)
                    <tr wire:key="item-{{$key->id}}" >
                        <td>{{$key->id}}</td>
                        <td>{{$key->cantidad}}</td>
                        <td>{{$key->cantidad*$key->dolar}}</td>
                        <td>{{$key->fecha}}</td>
                        <td>{{$key->tipo}}</td>
                        <td>
                            <x-button wire:click="editar({{$key->id}})" >
                              <i class="fa-solid fa-pen-to-square"></i>
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
            <h1>Registrar Ingreso</h1>
        </x-slot>
        <x-slot name='content'>
            <form class="form" id='form-registrar' wire:submit='registrar'>
                
                <x-label class='mt-4'>Tipo de pago</x-label>
                <x-select wire:model.live="registrarForm.tipo" name="forma" class='w-full form-control'>
                    <option value="" >Seleccione</option>
                    <option value='Aranceles'>Aranceles</option>
                    <option value='Uniformes'>Uniformes</option>
                    <option value='Mensualidad'>Mensualidad</option>
                </x-select>
                <x-input-error for="registrarForm.tipo"/>
        
                <x-label>Representante</x-label>
                
                <x-select wire:model.live='registrarForm.representante_id' name="id" class="w-full" id='repre_id_reg' >
                    
                    <option value="">Seleccione</option>
                    
                    @forelse($listaRepre as $key)
                        
                        <option value="{{$key->id}}">{{$key->cedula.'-'.$key->nombre.' '.$key->paterno}}</option>    
                    
                    @empty    

                    @endforelse

                </x-select>
                <x-input-error for="registrarForm.representante_id"/>
                
                @if($listaEstu->count())
                    
                    <x-label class='mt-4'>Estudiante</x-label>
                    
                    @forelse($listaEstu as $key)  
                        
                        <label> 
                            <input type="checkbox" wire:model="estudiantes" value="{{$key->estudiante->id}}" name='estudiantes'>
                            {{$key->estudiante->nombre.' '.$key->estudiante->paterno}}
                        </label>
                    @empty

                    @endforelse

                @endif
                
                <x-input-error for="registrarForm.estudiante_id"/>

                <x-label class='mt-4'>Cantidad(en $)</x-label>
                <x-input wire:model="registrarForm.cantidad" type="number" step='0.1' min='0.1' max='1000' name="cantidad" placeholder='Cantidad en dolares' class='w-full' autocomplete="off" />
                <x-input-error for="registrarForm.cantidad"/>

                
                @if( $mostrarMeses )
                    <table class="w-full">
                        <tbody>
                        <tr>
                            <td>
                                <label>Enero  
                                    <input type="checkbox" wire:model='meses' value="Enero">
                                </label>
                    
                            </td>
                            <td>
                                <label>Febrero  
                                    <input type="checkbox" wire:model='meses' value="Febrero">
                                </label>            
                            </td>
                            <td>
                                <label>Marzo 
                                    <input type="checkbox" wire:model='meses' value="Marzo">
                                </label>            
                            </td>
                            <td>
                                <label>Abril  
                                    <input type="checkbox" wire:model='meses' value="Abril">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Mayo  
                                    <input type="checkbox" wire:model='meses' value="Mayo">
                                </label>            
                            </td>        
                            <td>
                                <label>Junio  
                                    <input type="checkbox" wire:model='meses' value="Junio">
                                </label>            
                            </td>        
                            
                            <td>
                                <label>Julio  
                                    <input type="checkbox" wire:model='meses' value="Julio">
                                </label>
                            </td>        
                            <td>
                                <label>Agosto  
                                    <input type="checkbox" wire:model='meses' value="Agosto">
                                </label>
                            </td>        
                        </tr>
                        <tr>
                            <td>
                                <label>Septiembre 
                                    <input type="checkbox" wire:model='meses' value="Septiembre">
                                </label>
                            </td>
                            <td>
                                <label>Octubre  
                                    <input type="checkbox" wire:model='meses' value="Octubre">
                                </label>
                            </td>
                            <td>
                                <label>Noviembre
                                    <input type="checkbox" wire:model='meses' value="Noviembre">
                                </label>            
                            </td>
                            <td>
                                <label>Diciembre
                                    <input type="checkbox" wire:model='meses' value="Diciembre">
                                </label>     
                            </td>
                        </tr>    
                        </tbody>
                    </table>
                    <label class="mt-4">Año</label>
                    <x-select wire:model='ahno' class="w-full">
                        <option value="">Seleccione</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                    </x-select>
                @endif

                <x-label class='mt-4'>Forma de Pago</x-label>
                <x-select wire:model.live="registrarForm.forma" name="forma" class='w-full form-control'>
                    <option value=""  >Seleccione</option>
                    <option value='Efectivo'>Efectivo</option>
                    <option value='Transferencia'>Transferencia</option>
                    <option value='Divisa'>Divisa</option>
                </x-select>
                <x-input-error for="registrarForm.forma"/>
                    
                @if( $mostrarCodigo )

                    <div>
                        <x-label class='mt-4'>Codigo (Opcional)</x-label>
                        <x-input wire:model="registrarForm.codigo" type="text" minlength='4' maxlength='4' placeholder='Codigo de la transferencia' class='w-full' autocomplete="off" />
                        <x-input-error for="registrarForm.codigo"/>
                    </div>
                    
                @endif

                <x-label class='mt-4'>Precio del dolar</x-label>
                <x-input wire:model="registrarForm.dolar" type="number" step='0.1' min='0.1' max='1000000000' name="dolar" placeholder='cantidad de Bolivares' class='w-full' autocomplete="off" />
                <x-input-error for="registrarForm.dolar"/>
                
                <x-label class='mt-4'>Fecha</x-label>
                <x-input wire:model="registrarForm.fecha" type="date" name="fecha" placeholder='Fecha' class='w-full'/>
                <x-input-error for="registrarForm.fecha"/> 
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
            <h1>Editar Pago</h1>
        </x-slot>
        <x-slot name='content'>
            <form class='form' id='form-actualizar' wire:submit='actualizar' >
                <x-label>Representante</x-label>
                
                <x-select wire:model.live='editarForm.representante_id' name="id" class="w-full" id='repre_id_reg' >
                
                    @forelse($listaRepre as $key)
                        
                        <option value="{{$key->id}}">{{$key->nombre}}</option>    
                    
                    @empty
                        
                        <option value="">Seleccione</option>    

                    @endforelse

                </x-select>
                <x-input-error for="editarForm.representante_id"/>

                <x-label class='mt-4'>Estudiante</x-label>
                
                <x-select wire:model='editarForm.estudiante_id' name="id" class="w-full" id='repre_id_reg' >
                
                    @forelse($listaEstu as $key)
                        
                        <option value="{{$key->estudiante->id}}">{{$key->estudiante->nombre}}</option>    
                    
                    @empty
                        
                        <option value="">Seleccione</option>    

                    @endforelse

                </x-select>
                <x-input-error for="editarForm.estudiante_id"/>

                <x-label class='mt-4'>Cantidad(en $)</x-label>
                <x-input wire:model="editarForm.cantidad" type="number" step='0.01' min='0.01' max='1000' name="cantidad" placeholder='Cantidad de Dolares' class='w-full'/>
                <x-input-error for="editarForm.cantidad"/>

                <x-label class='mt-4'>Tipo de pago</x-label>
                <x-select wire:model="editarForm.tipo" name="nivel" class='w-full form-control'>
                    <option value="" disabled="">Seleccione</option>
                    <option value='Aranceles'>Aranceles</option>
                    <option value='Uniformes'>Uniformes</option>
                    <option value='Mensualidad'>Mensualidad</option>
                </x-select>
                <x-input-error for="editarForm.tipo"/>

                <x-label class='mt-4'>Forma de Pago</x-label>
                <x-select wire:model="editarForm.forma" name="forma" class='w-full form-control'>
                    <option value=""  disabled="">Seleccione</option>
                    <option value='Efectivo'>Efectivo</option>
                    <option value='Transferencia'>Transferencia</option>
                    <option value='Divisa'>Divisa</option>
                </x-select>
                <x-input-error for="editarForm.forma"/>

                <x-label class='mt-4'>Codigo (Opcional)</x-label>
                <x-input wire:model="editarForm.codigo" type="number" step='0.1' min='0.1' max='1000' name="cantidad" placeholder='Cantidad en dolares' class='w-full' autocomplete="off" />
                <x-input-error for="editarForm.codigo"/>

                <x-label class='mt-4'>Precio del dolar</x-label>
                <x-input wire:model="editarForm.dolar" type="number" step='0.01' min='0.01' max='1000000' name="dolar" placeholder='Cantidad en bolivares' class='w-full'/>
                <x-input-error for="editarForm.dolar"/>
                
                <x-label class='mt-4'>Fecha</x-label>
                <x-input wire:model="editarForm.fecha" type="date" name="fecha" placeholder='Fecha' class='w-full'/>
                <x-input-error for="editarForm.fecha"/>

                
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

    <x-dialog-modal wire:model='openReporte'>
        <x-slot name='title'>
            <h1>Imprimir Reporte</h1>
        </x-slot>
        <x-slot name='content'>
            <form id='form-reporte' wire:submit='imprimir' >
                
                <x-label class='mt-4'>Estudiante</x-label>
                <x-select wire:model="imprimirForm.estudiante_id" name="tipo" class='w-full form-control'>
                    <option value="">Seleccione</option>
                    @foreach($listaEstu as $key)
                         <option value="{{$key->estudiante->id}}">{{$key->estudiante->nombre}}</option> 
                    @endforeach
                </x-select>
                <x-input-error for="imprimirForm.estudiante_id"/>

                <x-label class='mt-4'>Tipo de pago</x-label>
                <x-select wire:model="imprimirForm.tipo" name="tipo" class='w-full form-control'>
                    <option value="">Seleccione</option>
                    
                        <option value='Aranceles'>Aranceles</option>
                        <option value='Uniformes'>Uniformes</option>
                        <option value='Matricula'>Matricula</option>
                    
                </x-select>
                <x-input-error for="imprimirForm.tipo"/>

                <x-label class='mt-4'>Año escolar</x-label>
                <x-select wire:model="imprimirForm.aescolar" name="aescolars" class='w-full form-control'>
                    <option value="">Seleccione</option>
                    @foreach($aescolars as $key)
                        <option value='{{$key->id}}'>{{$key->inicio}} - {{$key->final}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="imprimirForm.aescolar"/>
                
            </form>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('openReporte',false)" class='mr-2' wire:loading.remove wire:target='imprimir' >
                <i class="fa-solid fa-ban mr-2"></i> 
                Cancelar
            </x-secondary-button>
            <x-button type='submit' form='form-reporte'>
                <span wire:loading wire:target='imprimir'>Cargando...</span>
                <span wire:loading.remove wire:target='imprimir'>
                    <i class="fa-solid fa-file-pdf mr-2"></i> 
                    Imprimir
                </span>
            </x-button>
        </x-slot>
    </x-dialog-modal>

    @section('scripts')

    @endsection

</div>