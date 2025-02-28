<div>
    <h1>Registrar Inscripcion</h1>
    		
    <form wire:submit='registrar'>
	    <div class="flex flex-col md:flex-row gap-4 p-2">
	        
	    <!-- Datos Estudiante -->
	        
	        <div class="flex-1 p-2 rounded-lg shadow-md">
	            <h1 class='center'>Datos Estudiante</h1>
	            <x-label>Cedula</x-label>
                <x-input wire:model='estudianteForm.cedula' type="text" name="cedula" placeholder='Cedula' class='w-full' pattern="^[0-9]+$" title='Solo numeros'/>
                <x-input-error for="estudianteForm.cedula"/>

                <x-label class='mt-4'>Primer Nombre</x-label>
                <x-input wire:model="estudianteForm.nombre" type="text" name="nombre" placeholder='Primer Nombre' class='w-full'/>
                <x-input-error for="estudianteForm.nombre"/>

                <x-label class='mt-4'>Segundo Nombre</x-label>
                <x-input wire:model="estudianteForm.segundo" type="text" name="segundo" placeholder='Segundo Nombre' class='w-full'/>
                <x-input-error for="estudianteForm.segundo"/>

                <x-label class='mt-4'>Primer Apellido</x-label>
                <x-input wire:model="estudianteForm.paterno" type="text" name="paterno" placeholder='Primer Apellido' class='w-full'/>
                <x-input-error for="estudianteForm.paterno"/>

                <x-label class='mt-4'>Segundo Apellido</x-label>
                <x-input wire:model="estudianteForm.materno" type="text" name="materno" placeholder='Segundo Apellido' class='w-full'/>
                <x-input-error for="estudianteForm.materno"/>

                <x-label class='mt-4'>Fecha de nacimiento</x-label>
                <x-input wire:model="estudianteForm.fecha" type="date" name="fecha" placeholder='Fecha de nacimiento' class='w-full'/>
                <x-input-error for="estudianteForm.fecha"/>

                <x-label class='mt-4'>Lugar de nacimiento</x-label>
                <div class="p-1">    
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
                        <x-select wire:model.live='estudianteForm.parroquia_id' class="flex-grow-1 m-1">
                            <option value="">Parroquia</option>
                            @foreach($parroquias as $key)
                                <option value="{{$key->id}}">{{$key->nombre}}</option>
                            @endforeach
                        </x-select>
                    </div>    
                    <x-input wire:model="estudianteForm.lugar" type="text" name="lugar" placeholder='Referencia' class='w-full'/>
                    <x-input-error for="estudianteForm.lugar"/>
                </div>    
                <x-label class='mt-4'>Sexo</x-label>
                <x-select wire:model="estudianteForm.sexo" name="sexo" class='w-full form-control'>
                    <option value="" disabled="">Seleccione</option>
                    <option value="m">Masculino</option>
                    <option value="f">Femenina</option>
                </x-select>
                <x-input-error for="estudianteForm.sexo"/>

                <x-label class='mt-4'>Institucion de Procedencia</x-label>
                <x-input wire:model="estudianteForm.institucion_procedencia" type="text" placeholder='Institucion de Procedencia' class='w-full'/>
                <x-input-error for="estudianteForm.institucion_procedencia"/>

                <x-label class='mt-4'>Utiliza Lentes?</x-label>
                <x-select wire:model="estudianteForm.lentes" class='w-full' >
                	<option value="" >Seleccione</option>
                	<option value="si" >sí</option>
                	<option value="no" >no</option>
                </x-select> 
                <x-input-error for="estudianteForm.lentes"/>

                <x-label class='mt-4'>Tratamiento <small>(Opcional)</small></x-label>
                <x-input wire:model="estudianteForm.tratamiento" type="text" placeholder='Tratamiento' class='w-full'/>
                <x-input-error for="estudianteForm.tratamiento"/> 
        			
                <x-label class='mt-4'>Vive con:</x-label>
                	@foreach($estudianteForm->opcionesVive as $key)
                		<label>
                			<input type="checkbox" wire:model='estudianteForm.selectedVive' value='{{$key}}' >
                			{{$key}}
                		</label>
                	@endforeach
                <x-input-error for="estudianteForm.vive_con"/>

                <x-label class='mt-4'>Tipo de parto</x-label>
                <x-select wire:model="estudianteForm.parto" class='w-full' >
                	<option value="" >Seleccione</option>
                	<option value="natural" >Natural</option>
                	<option value="cesarea" >Cesarea</option>
                </x-select> 
                <x-input-error for="estudianteForm.parto"/>

                <!-- datos de la inscripcion -->
                <h1>Datos de inscripcion</h1>	
                <hr>		

                <x-label class='mt-4'>Nivel Academico</x-label>
                <x-select wire:model="estudianteForm.nivel_id" name="nivel" class='w-full form-control'>
                    <option value=""  disabled="">Seleccione</option>
                    @foreach($nivels as $key)
                        <option value='{{$key->id}}'>{{$key->nombre}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="estudianteForm.nivel_id"/>

                <x-label class='mt-4'>Seccion</x-label>
                <x-select wire:model="estudianteForm.seccion_id" name="seccion" class='w-full form-control'>
                    <option value="" disabled="">Seleccione</option>
                    @foreach($seccions as $key)
                        <option value="{{$key->id}}">{{$key->nombre}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="estudianteForm.seccion_id"/>

                <x-label class='mt-4'>Año escolar</x-label>
                <x-select wire:model="estudianteForm.aescolar_id" name="aescolar_id" class='w-full form-control'>
                    <option value="" disabled="">Seleccione</option>
                    @foreach($aescolars as $key)
                        <option value="{{$key->id}}">{{$key->inicio}}-{{$key->final}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="estudianteForm.aescolar_id"/>	
	        </div>
	
	<!-- Datos Representates -->
	        
	        <div class="flex-1 p-2 rounded-lg shadow-md">
	            <h1>Datos Representantes</h1>

                <x-label>Cedula</x-label>
                <x-input wire:model='representanteForm.cedula' type="number" min='1000000' max='1000000000' placeholder='Cedula del Representante' class='w-full' />
                <x-input-error for="representanteForm.cedula"/>

                <x-label class='mt-4'>Primer Nombre</x-label>
                <x-input wire:model="representanteForm.nombre" type="text"  placeholder='Primer Nombre del Representante' class='w-full' />
                <x-input-error for="representanteForm.nombre"/>

                <x-label class='mt-4'>Segundo Nombre</x-label>
                <x-input wire:model="representanteForm.segundo" type="text" name="segundo" placeholder='Segundo Nombre del Representante' class='w-full' />
                <x-input-error for="representanteForm.segundo"/>

                <x-label class='mt-4'>Primer Apellido</x-label>
                <x-input wire:model="representanteForm.paterno" type="text" name="paterno" placeholder='Primer Apellido del Representante' class='w-full' />
                <x-input-error for="representanteForm.paterno"/>

                <x-label class='mt-4'>Segundo Apellido</x-label>
                <x-input wire:model="representanteForm.materno" type="text" name="materno" placeholder='Segundo Apellido del Representante' class='w-full'/>
                <x-input-error for="representanteForm.materno"/>

                <x-label class='mt-4'>Estado Civil</x-label>
                <x-select wire:model='estado_civil' >
                    <option value="">Seleccione</option>
                    <option value="Soltero(a)">Soltero(a)</option>
                    <option value="Casado(a)">Casado(a)</option>
                    <option value="Divorciado(a)">Divorciado(a)</option>
                    <option value="Viudo(a)">Viudo(a)</option>
                    <option value="Concubinato">Concubinato</option>
                </x-select>
                <x-input-error for="representanteForm.estado_civil"/>

                <x-label class='mt-4'>Estado Civil</x-label>
                <x-select wire:model='condicion_laboral' >
                    <option value="">Seleccione</option>
                    <option value="Empleado(a)">Empleado(a)</option>
                    <option value="Desempleado(a)">Desempleado(a)</option>
                </x-select>
                <x-input-error for="representanteForm.condicion_laboral"/>

                <x-label class='mt-4'>Oficio</x-label>
                <x-input wire:model="representanteForm.oficio" type="text" name="materno" placeholder='oficio del Representante' class='w-full'/>
                <x-input-error for="representanteForm.oficio"/>

                <x-label class='mt-4'>Direccion de Habitacion</x-label>
                <x-input wire:model="representanteForm.direccion_habitacion" type="text" name="materno" placeholder='Direccion de Habitacion' class='w-full'/>
                <x-input-error for="representanteForm.direccion_habitacion"/>

                <x-label class='mt-4'>Direccion de Trabajo</x-label>
                <x-input wire:model="representanteForm.direccion_trabajo" type="text" name="materno" placeholder='Direccion de Trabajo' class='w-full'/>
                <x-input-error for="representanteForm.direccion_trabajo"/>

                <x-label class='mt-4'>Lugar de nacimiento</x-label>
                <x-input wire:model="representanteForm.lugar_nacimiento" type="text" placeholder='Lugar de Nacimiento' class='w-full'/>
                <x-input-error for="representanteForm.lugar_nacimiento"/>

                <x-label class='mt-4'>Fecha de Nacimiento</x-label>
                <x-input wire:model="representanteForm.fecha" type="date" class='w-full'/>
                <x-input-error for="representanteForm.fecha"/>


                <x-label class='mt-4'>Telefono</x-label>
                
                <x-input wire:model="representanteForm.telefono" type="text" name="direccion" placeholder='Telefono del Representante' class='w-full mb-2' minlength='11' maxlength='11' />
                
                <x-input-error for="representanteForm.telefono" />

                <x-label class='mt-4'>Relacion con el estudiante</x-label>
                <x-select wire:model="representadoForm.relacion" class='w-full'>
                    <option value="Legal" selected>Tutor Legal</option>        
                    <option value="Autorizado">Autorizado</option>        
                </x-select>
                <x-label class='mt-4'>Parentesco con el estudiante</x-label>
                <x-select wire:model="representadoForm.parentesco" class='w-full'>
                    <option value="Madre" selected>Madre</option>        
                    <option value="Padre">Padre</option>        
                    <option value="Abuelo(a)">Abuelo(a)</option>        
                    <option value="Tio(a)">Tio(a)</option>        
                    <option value="Hermano(a)">Hermano(a)</option>        
                    <option value="Primo(a)">Primo(a)</option>        
                    <option value="Otro">Otro(a)</option>        
                </x-select>
	        </div> 	
	    			
	    <!-- Datos Hogar -->
	    			
	        <div class="flex-1 p-2 rounded-lg shadow-md">
	            	
	            <h1>Datos Hogar</h1>

	            <x-label class='mt-4'>Numero de personas que viven en el hogar</x-label>
                <x-input wire:model="hogarForm.numero_mayores" type="text" placeholder='Numero de Mayores' class='w-full mb-2'/>
                <x-input-error for="hogarForm.numero_mayores"/>

                <x-input wire:model="hogarForm.numero_menores" type="text" placeholder='Numero de Mayores' class='w-full mb-2'/>
                <x-input-error for="hogarForm.numero_menores"/>

                <x-label class='mt-4'>Numero de Familias</x-label>
                <x-input wire:model="hogarForm.numero_familias" type="text" placeholder='Numero de Familias' class='w-full mb-2'/>
                <x-input-error for="hogarForm.numero_familias"/>

                <x-label class='mt-4'>Numero de ambitos</x-label>
                <x-input wire:model="hogarForm.numero_ambitos" type="text" placeholder='Numero de Ambitos' class='w-full mb-2'/>
                <x-input-error for="hogarForm.numero_ambitos"/>

                <x-label class='mt-4'>Representante Economico</x-label>
                <x-select wire:model="hogarForm.representante_economico" class='w-full' >
                	<option value="Padre" >Padre</option>
                	<option value="Madre" >Madre</option>
                	<option value="Ambos" >Ambos</option>
                	<option value="Otro" >Otro</option>
                </x-select> 
                <x-input-error for="hogarForm.representante_economico"/>

                <x-label class='mt-4'>Gastos separados</x-label>
                <x-select wire:model="hogarForm.gastos_separados" class='w-full' >
                	<option value="si" >sí</option>
                	<option value="no" >no</option>
                </x-select> 
                <x-input-error for="hogarForm.gastos_separados"/>

                <x-label class='mt-4'>Numero de dormitorios</x-label>
                <x-input wire:model="hogarForm.numero_dormitorios" type="text" placeholder='Numero de Dormitorios' class='w-full mb-2'/>
                <x-input-error for="hogarForm.numero_dormitorios"/>
                        
	        </div>		
	    </div>          
	    <x-button>      
	    	Registrar   
	    </x-button>	    
    </form>			    
</div>				    