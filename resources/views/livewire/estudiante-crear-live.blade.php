<div>
    <h1>Registrar Inscripcion</h1>
    		
    <form wire:model='registrar'>
	    <div class="flex flex-col md:flex-row gap-4 p-2">
	        
	    <!-- Datos Estudiante -->
	        
	        <div class="flex-1 p-2 rounded-lg shadow-md">
	            <h1 class='center'>Datos Estudiante</h1>
	            <x-label>Cedula</x-label>
                <x-input wire:model='form.cedula' type="text" name="cedula" placeholder='Cedula' class='w-full' pattern="^[0-9]+$" title='Solo numeros'/>
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
                    <option value="" disabled="">Seleccione</option>
                    <option value="m">Masculino</option>
                    <option value="f">Femenina</option>
                </x-select>
                <x-input-error for="form.sexo"/>

                <x-label class='mt-4'>Institucion de Procedencia</x-label>
                <x-input wire:model="form.institucion_procedencia" type="text" placeholder='Institucion Procedencia' class='w-full'/>
                <x-input-error for="form.institucion_procedencia"/>

                <x-label class='mt-4'>Utiliza Lentes?</x-label>
                <x-select wire:model="form.lentes" class='w-full' >
                	<option value="si" >sí</option>
                	<option value="no" >no</option>
                </x-select> 
                <x-input-error for="form.lentes"/>

                <x-label class='mt-4'>Tratamiento <small>(Opcional)</small></x-label>
                <x-input wire:model="form.tratamiento" type="text" placeholder='Tratamiento' class='w-full'/>
                <x-input-error for="form.tratamiento"/>
        			
                <x-label class='mt-4'>Vive con:</x-label>
                	@foreach($opcionesVive as $key)
                		<label>
                			<input type="checkbox" wire:model='selectedVive' value='{{$key}}' >
                			{{$key}}
                		</label>
                	@endforeach
                <x-input-error for="form.vive_con"/>

                <x-label class='mt-4'>Tipo de parto</x-label>
                <x-select wire:model="form.parto" class='w-full' >
                	<option value="natural" >Natural</option>
                	<option value="cesarea" >Cesarea</option>
                </x-select> 
                <x-input-error for="form.parto"/>

                <!-- datos de la inscripcion -->
                <h1>Datos de inscripcion</h1>	
                <hr>		

                <x-label class='mt-4'>Nivel Academico</x-label>
                <x-select wire:model="form.nivel_id" name="nivel" class='w-full form-control'>
                    <option value=""  disabled="">Seleccione</option>
                    @foreach($nivels as $key)
                        <option value='{{$key->id}}'>{{$key->nombre}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.nivel_id"/>

                <x-label class='mt-4'>Seccion</x-label>
                <x-select wire:model="form.seccion_id" name="seccion" class='w-full form-control'>
                    <option value="" disabled="">Seleccione</option>
                    @foreach($seccions as $key)
                        <option value="{{$key->id}}">{{$key->nombre}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.seccion_id"/>

                <x-label class='mt-4'>Año escolar</x-label>
                <x-select wire:model="form.aescolar_id" name="aescolar_id" class='w-full form-control'>
                    <option value="" disabled="">Seleccione</option>
                    @foreach($aescolars as $key)
                        <option value="{{$key->id}}">{{$key->inicio}}-{{$key->final}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="form.aescolar_id"/>	
	        </div>
	
	<!-- Datos Representates -->
	        
	        <div class="flex-1 p-2 rounded-lg shadow-md">
	            <h1>Datos Representantes</h1>

                <x-label>Cedula</x-label>
                <x-input wire:model='representante.cedula' type="number" min='1000000' max='1000000000' placeholder='Cedula del Representante' class='w-full' />
                <x-input-error for="representante.cedula"/>

                <x-label class='mt-4'>Primer Nombre</x-label>
                <x-input wire:model="representante.nombre" type="text"  placeholder='Primer Nombre del Representante' class='w-full' />
                <x-input-error for="representante.nombre"/>

                <x-label class='mt-4'>Segundo Nombre</x-label>
                <x-input wire:model="representante.segundo" type="text" name="segundo" placeholder='Segundo Nombre del Representante' class='w-full' />
                <x-input-error for="representante.segundo"/>

                <x-label class='mt-4'>Primer Apellido</x-label>
                <x-input wire:model="representante.paterno" type="text" name="paterno" placeholder='Primer Apellido del Representante' class='w-full' />
                <x-input-error for="representante.paterno"/>

                <x-label class='mt-4'>Segundo Apellido</x-label>
                <x-input wire:model="representanteRegistrar.materno" type="text" name="materno" placeholder='Segundo Apellido del Representante' class='w-full'/>
                <x-input-error for="representanteRegistrar.materno"/>

                <x-label class='mt-4'>Direccion</x-label>
                <x-input wire:model="representante.direccion" type="text" name="direccion" placeholder='Direccion del Representante' class='w-full mb-2'/>
                <x-input-error for="representante.direccion"/>

                <x-label class='mt-4'>Telefono</x-label>
                
                <x-input wire:model="representante.telefono" type="text" name="direccion" placeholder='Telefono del Representante' class='w-full mb-2' minlength='11' maxlength='11' />
                
                <x-input-error for="representante.telefono" />

                <x-label class='mt-4'>Relacion con el estudiante</x-label>
                <x-select wire:model="representanteForm.relacion" class='w-full'>
                    <option value="Legal" selected>Tutor Legal</option>        
                    <option value="Autorizado">Autorizado</option>        
                </x-select>
	        </div> 	
	    			
	    <!-- Datos Hogar -->
	    			
	        <div class="flex-1 p-2 rounded-lg shadow-md">
	            	
	            <h1>Datos Hogar</h1>

	            <x-label class='mt-4'>Numero de personas que viven en el hogar</x-label>
                <x-input wire:model="hogar.numero_mayores" type="text" placeholder='Numero de Mayores' class='w-full mb-2'/>
                <x-input-error for="hogar.numero_mayores"/>

                <x-input wire:model="hogar.numero_menores" type="text" placeholder='Numero de Mayores' class='w-full mb-2'/>
                <x-input-error for="hogar.numero_menores"/>

                <x-label class='mt-4'>Numero de Familias</x-label>
                <x-input wire:model="hogar.numero_familias" type="text" placeholder='Numero de Familias' class='w-full mb-2'/>
                <x-input-error for="hogar.numero_familias"/>

                <x-label class='mt-4'>Numero de ambitos</x-label>
                <x-input wire:model="hogar.numero_ambitos" type="text" placeholder='Numero de Ambitos' class='w-full mb-2'/>
                <x-input-error for="hogar.numero_ambitos"/>
				
                <x-label class='mt-4'>Representante Economico</x-label>
                <x-select wire:model="form.representante_economico" class='w-full' >
                	<option value="Padre" >Padre</option>
                	<option value="Madre" >Madre</option>
                	<option value="Ambos" >Ambos</option>
                	<option value="Otro" >Otro</option>
                </x-select> 
                <x-input-error for="form.representante_economico"/>

                <x-label class='mt-4'>Gastos separados</x-label>
                <x-select wire:model="form.gastos_separados" class='w-full' >
                	<option value="si" >sí</option>
                	<option value="no" >no</option>
                </x-select> 
                <x-input-error for="form.gastos_separados"/>

                <x-label class='mt-4'>Numero de dormitorios</x-label>
                <x-input wire:model="hogar.numero_dormitorios" type="text" placeholder='Numero de Dormitorios' class='w-full mb-2'/>
                <x-input-error for="hogar.numero_dormitorios"/>

	        </div>		
	    </div>
	    <x-button>
	    	Registrar
	    </x-button>		
    </form>			
</div>				