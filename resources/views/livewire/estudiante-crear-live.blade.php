<div>
    @if($mostrarFormulario)
    <div class='flex'>
        <h1 class='flex-1'>Registrar Inscripcion</h1>
        <button wire:click='cerrarFormulario'><i class='fa-solid fa-xmark'></i></button>
    </div>		
    <form wire:submit='registrar'>
	    <div class="flex flex-col md:flex-row gap-4 p-2">
	        
	    <!-- Datos Estudiante -->
	        
	        <div class="flex-1 p-2 rounded-lg shadow-md">
	            <h1 class='text-center mb-2'>Datos Estudiante</h1>
	            <hr>

	            <x-label class='mt-2'>Cedula <small>(Opcional)</small></x-label>
                <x-input wire:model='estudianteForm.cedula' type="text" name="cedula" placeholder='Cedula' class='w-full fill-number' pattern="^[0-9]+$" title='Solo numeros'/>
                <x-input-error for="estudianteForm.cedula"/>

                <x-label class='mt-4'>Primer Nombre</x-label>
                <x-input wire:model="estudianteForm.nombre" type="text" name="nombre" placeholder='Primer Nombre' class='w-full fill-string'/>
                <x-input-error for="estudianteForm.nombre"/>

                <x-label class='mt-4'>Segundo Nombre <small>(Opcional)</small></x-label>
                <x-input wire:model="estudianteForm.segundo" type="text" name="segundo" placeholder='Segundo Nombre' class='w-full'/>
                <x-input-error for="estudianteForm.segundo"/>

                <x-label class='mt-4'>Primer Apellido</x-label>
                <x-input wire:model="estudianteForm.paterno" type="text" name="paterno" placeholder='Primer Apellido' class='w-full fill-string' />
                <x-input-error for="estudianteForm.paterno"/>

                <x-label class='mt-4'>Segundo Apellido <small>(Opcional)</small></x-label>
                <x-input wire:model="estudianteForm.materno" type="text" name="materno" placeholder='Segundo Apellido' class='w-full'/>
                <x-input-error for="estudianteForm.materno"/>

                <x-label class='mt-4'>Fecha de nacimiento</x-label>
                <x-input wire:model="estudianteForm.fecha" type="date" name="fecha" placeholder='Fecha de nacimiento' class='w-full fill-date'/>
                <x-input-error for="estudianteForm.fecha"/>

                <x-label class='mt-4'>Lugar de nacimiento</x-label>
                <div class="p-2">    
                    <div class="flex flex-column">    
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
                    <x-input wire:model="estudianteForm.lugar" type="text" name="lugar" placeholder='Referencia (opcional)' class='w-full'/>
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
                <x-select wire:model="estudianteForm.parto" class='w-full mb-2' >
                	<option value="" >Seleccione</option>
                	<option value="natural" >Natural</option>
                	<option value="cesarea" >Cesarea</option>
                </x-select> 
                <x-input-error for="estudianteForm.parto"/>

                <!-- datos de la inscripcion -->
                <h1 class='text-center mb-2'>Datos de inscripcion</h1>	
                <hr>		

                <x-label class='mt-4'>Nivel Academico</x-label>
                <x-select wire:model="cursaForm.nivel_id" name="nivel" class='w-full form-control'>
                    <option value=""  disabled="">Seleccione</option>
                    @foreach($nivels as $key)
                        <option value='{{$key->id}}'>{{$key->nombre}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="cursaForm.nivel_id"/>

                <x-label class='mt-4'>Seccion</x-label>
                <x-select wire:model="cursaForm.seccion_id" name="seccion" class='w-full form-control'>
                    <option value="" disabled="">Seleccione</option>
                    @foreach($seccions as $key)
                        <option value="{{$key->id}}">{{$key->nombre}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="cursaForm.seccion_id"/>

                <x-label class='mt-4'>Año escolar</x-label>
                <x-select wire:model="cursaForm.aescolar_id" name="aescolar_id" class='w-full form-control'>
                    <option value="" disabled="">Seleccione</option>
                    @foreach($aescolars as $key)
                        <option value="{{$key->id}}">{{$key->inicio}}-{{$key->final}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="cursaForm.aescolar_id"/>	
	        </div>
	
	    <!-- Datos Representates -->
	        
	        <div class="flex-1 p-2 rounded-lg shadow-md">
	            <h1 class="text-center mb-2">Datos Representante Legal</h1>
	            <hr>
	            <div class='flex'>
		            <x-label class='m-2'>
		            	<input type="radio" wire:click="mostrarRepresentanteRegistrado(false)" name='representanteRegistrado'>No registrado
		            </x-label>
		            <x-label class='m-2'>
		            	<input type="radio" wire:click="mostrarRepresentanteRegistrado(true)" name='representanteRegistrado'>Registrado
		            </x-label>
		        </div>    

		        @if(!$representanteRegistrado)

	                <x-label>Cedula</x-label>
	                <x-input wire:model='representanteForm.cedula' type="number" min='1000000' max='1000000000' placeholder='Cedula del Representante' class='w-full' />
	                <x-input-error for="representanteForm.cedula"/>

	                <x-label class='mt-4'>Primer Nombre</x-label>
	                <x-input wire:model="representanteForm.nombre" type="text"  placeholder='Primer Nombre del Representante' class='w-full' />
	                <x-input-error for="representanteForm.nombre"/>

	                <x-label class='mt-4'>Segundo Nombre <small>(Opcional)</small></x-label>
	                <x-input wire:model="representanteForm.segundo" type="text" name="segundo" placeholder='Segundo Nombre del Representante' class='w-full' />
	                <x-input-error for="representanteForm.segundo"/>

	                <x-label class='mt-4'>Primer Apellido</x-label>
	                <x-input wire:model="representanteForm.paterno" type="text" name="paterno" placeholder='Primer Apellido del Representante' class='w-full' />
	                <x-input-error for="representanteForm.paterno"/>

	                <x-label class='mt-4'>Segundo Apellido <small>(Opcional)</small></x-label>
	                <x-input wire:model="representanteForm.materno" type="text" name="materno" placeholder='Segundo Apellido del Representante' class='w-full'/>
	                <x-input-error for="representanteForm.materno"/>

	                <x-label class='mt-4'>Estado Civil</x-label>
	                <x-select wire:model='representanteForm.estado_civil' class='w-full'> >
	                    <option value="">Seleccione</option>
	                    <option value="Soltero(a)">Soltero(a)</option>
	                    <option value="Casado(a)">Casado(a)</option>
	                    <option value="Divorciado(a)">Divorciado(a)</option>
	                    <option value="Viudo(a)">Viudo(a)</option>
	                    <option value="Concubinato">Concubinato</option>
	                </x-select>
	                <x-input-error for="representanteForm.estado_civil"/>

	                <x-label class='mt-4'>Condicion Laboral</x-label>
	                <x-select wire:model='representanteForm.condicion_laboral' class='w-full'> >
	                    <option value="">Seleccione</option>
	                    <option value="Empleado(a)">Empleado(a)</option>
	                    <option value="Desempleado(a)">Desempleado(a)</option>
	                </x-select>
	                <x-input-error for="representanteForm.condicion_laboral"/>

	                <x-label class='mt-4'>Oficio</x-label>
	                <x-input wire:model="representanteForm.oficio" type="text" name="materno" placeholder='oficio del Representante' class='w-full'/>
	                <x-input-error for="representanteForm.oficio"/>

	                <x-label class='mt-4'>Direccion de Habitacion</x-label>
	                <x-input wire:model="representanteForm.direccion_habitacion" type="text" placeholder='Direccion de Habitacion' class='w-full'/>
	                <x-input-error for="representanteForm.direccion_habitacion"/>

	                <x-label class='mt-4'>Direccion de Trabajo <small>(Opcional)</small></x-label>
	                <x-input wire:model="representanteForm.direccion_trabajo" type="text" placeholder='Direccion de Trabajo' class='w-full'/>
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

	                <x-label class='mt-4'>Parentesco con el estudiante</x-label>
	                <x-select wire:model.live="representadoForm.parentesco" class='w-full mb-2'>
	                    <option value="" selected>Seleccione</option>        
	                    <option value="Madre" >Madre</option>        
	                    <option value="Padre">Padre</option>        
	                    <option value="Abuelo(a)">Abuelo(a)</option>        
	                    <option value="Tio(a)">Tio(a)</option>        
	                    <option value="Hermano(a)">Hermano(a)</option>        
	                    <option value="Primo(a)">Primo(a)</option>        
	                    <option value="Otro">Otro(a)</option>        
	                </x-select>

                @else 	
                	<x-label > Seleccione Representante </x-label>
                	<x-select wire:model='representandoForm.estudiante_id' class='w-full mb-2'>
                		
                		@foreach($representantes as $key)
                			<option value='{{ $key->id }}'>{{ $key->nombre.' '.$key->paterno }}</option>
                		@endforeach

                	</x-select>

                	<x-label class='mt-4'>Parentesco con el estudiante</x-label>
	                <x-select wire:model.live="representadoForm.parentesco" class='w-full mb-2'>
	                    <option value="" selected>Seleccione</option>        
	                    <option value="Madre" >Madre</option>        
	                    <option value="Padre">Padre</option>        
	                    <option value="Abuelo(a)">Abuelo(a)</option>        
	                    <option value="Tio(a)">Tio(a)</option>        
	                    <option value="Hermano(a)">Hermano(a)</option>        
	                    <option value="Primo(a)">Primo(a)</option>        
	                    <option value="Otro">Otro(a)</option>        
	                </x-select>

                @endif	

            	<h1 class='text-center mb-2'>Datos Autorizado</h1>
                <hr>
                <div class='flex'>
		            <x-label class='m-2'>
		            	<input type="radio" wire:click="mostrarAutorizadoRegistrado(false)" name='autorizadoRegistrado'>No registrado
		            </x-label>
		            <x-label class='m-2'>
		            	<input type="radio" wire:click="mostrarAutorizadoRegistrado(true)" name='autorizadoRegistrado'>Registrado
		            </x-label>
		        </div>

			    @if(!$autorizadoRegistrado)

	                <x-label>Cedula</x-label>
	                <x-input wire:model='representanteFormAutorizado.cedula' type="number" min='1000000' max='1000000000' placeholder='Cedula del Representante' class='w-full' />
	                <x-input-error for="representanteFormAutorizado.cedula"/>

	                <x-label class='mt-4'>Primer Nombre</x-label>
	                <x-input wire:model="representanteFormAutorizado.nombre" type="text"  placeholder='Primer Nombre del Representante' class='w-full' />
	                <x-input-error for="representanteFormAutorizado.nombre"/>

	                <x-label class='mt-4'>Segundo Nombre <small>(Opcional)</small></x-label>
	                <x-input wire:model="representanteFormAutorizado.segundo" type="text" name="segundo" placeholder='Segundo Nombre del Representante' class='w-full' />
	                <x-input-error for="representanteFormAutorizado.segundo"/>

	                <x-label class='mt-4'>Primer Apellido</x-label>
	                <x-input wire:model="representanteFormAutorizado.paterno" type="text" name="paterno" placeholder='Primer Apellido del Representante' class='w-full' />
	                <x-input-error for="representanteFormAutorizado.paterno"/>

	                <x-label class='mt-4'>Segundo Apellido <small>(Opcional)</small></x-label>
	                <x-input wire:model="representanteFormAutorizado.materno" type="text" name="materno" placeholder='Segundo Apellido del Representante' class='w-full'/>
	                <x-input-error for="representanteFormAutorizado.materno"/>

	                <x-label class='mt-4'>Estado Civil</x-label>
	                <x-select wire:model='representanteFormAutorizado.estado_civil' class='w-full'> >
	                    <option value="">Seleccione</option>
	                    <option value="Soltero(a)">Soltero(a)</option>
	                    <option value="Casado(a)">Casado(a)</option>
	                    <option value="Divorciado(a)">Divorciado(a)</option>
	                    <option value="Viudo(a)">Viudo(a)</option>
	                    <option value="Concubinato">Concubinato</option>
	                </x-select>
	                <x-input-error for="representanteFormAutorizado.estado_civil"/>

	                <x-label class='mt-4'>Condicion Laboral</x-label>
	                <x-select wire:model='representanteFormAutorizado.condicion_laboral' class='w-full'> >
	                    <option value="">Seleccione</option>
	                    <option value="Empleado(a)">Empleado(a)</option>
	                    <option value="Desempleado(a)">Desempleado(a)</option>
	                </x-select>
	                <x-input-error for="representanteFormAutorizado.condicion_laboral"/>

	                <x-label class='mt-4'>Oficio</x-label>
	                <x-input wire:model="representanteFormAutorizado.oficio" type="text" name="materno" placeholder='oficio del Representante' class='w-full'/>
	                <x-input-error for="representanteFormAutorizado.oficio"/>

	                <x-label class='mt-4'>Direccion de Habitacion</x-label>
	                <x-input wire:model="representanteFormAutorizado.direccion_habitacion" type="text" placeholder='Direccion de Habitacion' class='w-full'/>
	                <x-input-error for="representanteFormAutorizado.direccion_habitacion"/>

	                <x-label class='mt-4'>Direccion de Trabajo <small>(Opcional)</small></x-label>
	                <x-input wire:model="representanteFormAutorizado.direccion_trabajo" type="text" placeholder='Direccion de Trabajo' class='w-full'/>
	                <x-input-error for="representanteFormAutorizado.direccion_trabajo"/>

	                <x-label class='mt-4'>Lugar de nacimiento</x-label>
	                <x-input wire:model="representanteFormAutorizado.lugar_nacimiento" type="text" placeholder='Lugar de Nacimiento' class='w-full'/>
	                <x-input-error for="representanteFormAutorizado.lugar_nacimiento"/>

	                <x-label class='mt-4'>Fecha de Nacimiento</x-label>
	                <x-input wire:model="representanteFormAutorizado.fecha" type="date" class='w-full'/>
	                <x-input-error for="representanteFormAutorizado.fecha"/>


	                <x-label class='mt-4'>Telefono</x-label>
	                
	                <x-input wire:model="representanteFormAutorizado.telefono" type="text" name="direccion" placeholder='Telefono del Representante' class='w-full mb-2' minlength='11' maxlength='11' />
	                
	                <x-input-error for="representanteFormAutorizado.telefono" />

	                <x-label class='mt-4'>Parentesco con el estudiante</x-label>
	                <x-select wire:model="representadoFormAutorizado.parentesco" class='w-full mb-2'>
	                    <option value="" selected>Seleccione</option>        
	                    <option value="Madre" >Madre</option>        
	                    <option value="Padre">Padre</option>        
	                    <option value="Abuelo(a)">Abuelo(a)</option>        
	                    <option value="Tio(a)">Tio(a)</option>        
	                    <option value="Hermano(a)">Hermano(a)</option>        
	                    <option value="Primo(a)">Primo(a)</option>        
	                    <option value="Otro">Otro(a)</option>        
	                </x-select>

	            @else
	            	<x-label > Seleccione Representante </x-label>
                	<x-select wire:model='autorizado_id' class='w-full mb-2'>
                		
                		@foreach($representantes as $key)
                			<option value='{{ $key->id }}'>{{ $key->nombre.' '.$key->paterno }}</option>
                		@endforeach

                	</x-select>

                	<x-label class='mt-4'>Parentesco con el estudiante</x-label>
	                <x-select wire:model.live="representadoForm.parentesco" class='w-full mb-2'>
	                    <option value="" selected>Seleccione</option>        
	                    <option value="Madre" >Madre</option>        
	                    <option value="Padre">Padre</option>        
	                    <option value="Abuelo(a)">Abuelo(a)</option>        
	                    <option value="Tio(a)">Tio(a)</option>        
	                    <option value="Hermano(a)">Hermano(a)</option>        
	                    <option value="Primo(a)">Primo(a)</option>        
	                    <option value="Otro">Otro(a)</option>        
	                </x-select>

	            @endif	

                @if($mostrarSegundoAutorizado)
					
					<h1 class='text-center mb-2'>Datos Segundo Autorizado</h1>
		            <hr/>
					<div class='flex'>
			            <x-label class='m-2'>
			            	<input type="radio" wire:click="mostrarAutorizado2Registrado(false)" name='representanteRegistrado'>No registrado
			            </x-label>
			            <x-label class='m-2'>
			            	<input type="radio" wire:click="mostrarAutorizado2Registrado(true)" name='representanteRegistrado'>Registrado
			            </x-label>
			        </div>

		            @if(!$autorizado2Registrado)		                
		                
		                <x-label>Cedula</x-label>
		                <x-input wire:model='representanteFormAutorizado2.cedula' type="number" min='1000000' max='1000000000' placeholder='Cedula del Representante' class='w-full' />
		                <x-input-error for="representanteFormAutorizado2.cedula"/>

		                <x-label class='mt-4'>Primer Nombre</x-label>
		                <x-input wire:model="representanteFormAutorizado2.nombre" type="text"  placeholder='Primer Nombre del Representante' class='w-full' />
		                <x-input-error for="representanteFormAutorizado2.nombre"/>

		                <x-label class='mt-4'>Segundo Nombre <small>(Opcional)</small></x-label>
		                <x-input wire:model="representanteFormAutorizado2.segundo" type="text" name="segundo" placeholder='Segundo Nombre del Representante' class='w-full' />
		                <x-input-error for="representanteFormAutorizado2.segundo"/>

		                <x-label class='mt-4'>Primer Apellido</x-label>
		                <x-input wire:model="representanteFormAutorizado2.paterno" type="text" name="paterno" placeholder='Primer Apellido del Representante' class='w-full' />
		                <x-input-error for="representanteFormAutorizado2.paterno"/>

		                <x-label class='mt-4'>Segundo Apellido <small>(Opcional)</small></x-label>
		                <x-input wire:model="representanteFormAutorizado2.materno" type="text" name="materno" placeholder='Segundo Apellido del Representante' class='w-full'/>
		                <x-input-error for="representanteFormAutorizado2.materno"/>

		                <x-label class='mt-4'>Estado Civil</x-label>
		                <x-select wire:model='representanteFormAutorizado2.estado_civil' class='w-full'> >
		                    <option value="">Seleccione</option>
		                    <option value="Soltero(a)">Soltero(a)</option>
		                    <option value="Casado(a)">Casado(a)</option>
		                    <option value="Divorciado(a)">Divorciado(a)</option>
		                    <option value="Viudo(a)">Viudo(a)</option>
		                    <option value="Concubinato">Concubinato</option>
		                </x-select>
		                <x-input-error for="representanteFormAutorizado2.estado_civil"/>

		                <x-label class='mt-4'>Condicion Laboral</x-label>
		                <x-select wire:model='representanteFormAutorizado2.condicion_laboral' class='w-full'> >
		                    <option value="">Seleccione</option>
		                    <option value="Empleado(a)">Empleado(a)</option>
		                    <option value="Desempleado(a)">Desempleado(a)</option>
		                </x-select>
		                <x-input-error for="representanteFormAutorizado2.condicion_laboral"/>

		                <x-label class='mt-4'>Oficio</x-label>
		                <x-input wire:model="representanteFormAutorizado2.oficio" type="text" name="materno" placeholder='oficio del Representante' class='w-full'/>
		                <x-input-error for="representanteFormAutorizado2.oficio"/>

		                <x-label class='mt-4'>Direccion de Habitacion</x-label>
		                <x-input wire:model="representanteFormAutorizado2.direccion_habitacion" type="text" placeholder='Direccion de Habitacion' class='w-full'/>
		                <x-input-error for="representanteFormAutorizado2.direccion_habitacion"/>

		                <x-label class='mt-4'>Direccion de Trabajo <small>(Opcional)</small></x-label>
		                <x-input wire:model="representanteFormAutorizado2.direccion_trabajo" type="text" placeholder='Direccion de Trabajo' class='w-full'/>
		                <x-input-error for="representanteFormAutorizado2.direccion_trabajo"/>

		                <x-label class='mt-4'>Lugar de nacimiento</x-label>
		                <x-input wire:model="representanteFormAutorizado2.lugar_nacimiento" type="text" placeholder='Lugar de Nacimiento' class='w-full'/>
		                <x-input-error for="representanteFormAutorizado2.lugar_nacimiento"/>

		                <x-label class='mt-4'>Fecha de Nacimiento</x-label>
		                <x-input wire:model="representanteFormAutorizado2.fecha" type="date" class='w-full'/>
		                <x-input-error for="representanteFormAutorizado2.fecha"/>


		                <x-label class='mt-4'>Telefono</x-label>
		                
		                <x-input wire:model="representanteFormAutorizado2.telefono" type="text" name="direccion" placeholder='Telefono del Representante' class='w-full mb-2' minlength='11' maxlength='11' />
		                
		                <x-input-error for="representanteFormAutorizado2.telefono" />

		                <x-label class='mt-4'>Parentesco con el estudiante</x-label>
		                <x-select wire:model="representadoFormAutorizado2.parentesco" class='w-full'>
		                    <option value="" selected>Seleccione</option>        
		                    <option value="Madre" >Madre</option>        
		                    <option value="Padre">Padre</option>        
		                    <option value="Abuelo(a)">Abuelo(a)</option>        
		                    <option value="Tio(a)">Tio(a)</option>        
		                    <option value="Hermano(a)">Hermano(a)</option>        
		                    <option value="Primo(a)">Primo(a)</option>        
		                    <option value="Otro">Otro(a)</option>        
		                </x-select>
		            @else
		            	
		            	<x-label > Seleccione Representante </x-label>
	                	<x-select wire:model='autorizado2_id' class='w-full mb-2'>
	                		
	                		@foreach($representantes as $key)
	                			<option value='{{ $key->id }}'>{{ $key->nombre.' '.$key->paterno }}</option>
	                		@endforeach

	                	</x-select>

	                	<x-label class='mt-4'>Parentesco con el estudiante</x-label>
		                <x-select wire:model.live="representadoFormAutorizado2.parentesco" class='w-full mb-2'>
		                    <option value="" selected>Seleccione</option>        
		                    <option value="Madre" >Madre</option>        
		                    <option value="Padre">Padre</option>        
		                    <option value="Abuelo(a)">Abuelo(a)</option>        
		                    <option value="Tio(a)">Tio(a)</option>        
		                    <option value="Hermano(a)">Hermano(a)</option>        
		                    <option value="Primo(a)">Primo(a)</option>        
		                    <option value="Otro">Otro(a)</option>        
		                </x-select>

		            @endif

                @endif

            </div> 	
	    			
	    <!-- Datos Hogar -->
	    			
	        <div class="flex-1 p-2 rounded-lg shadow-md">
	            	
	            <h1 class='text-center mb-2'>Datos Hogar</h1>
	            <hr>

	            <x-label class='mt-2'>Numero de personas que viven en el hogar</x-label>
                <x-input wire:model="hogarForm.numero_mayores" type="text" placeholder='Numero de Mayores de edad' class='w-full mb-2'/>
                <x-input-error for="hogarForm.numero_mayores"/>

                <x-input wire:model="hogarForm.numero_menores" type="text" placeholder='Numero de Menores de edad' class='w-full mb-2'/>
                <x-input-error for="hogarForm.numero_menores"/>

                <x-label class='mt-4'>Numero de Familias</x-label>
                <x-input wire:model="hogarForm.numero_familias" type="text" placeholder='Numero de Familias' class='w-full mb-2'/>
                <x-input-error for="hogarForm.numero_familias"/>

                <x-label class='mt-4'>Numero de ambitos</x-label>
                <x-input wire:model="hogarForm.numero_ambitos" type="text" placeholder='Numero de Ambitos' class='w-full mb-2'/>
                <x-input-error for="hogarForm.numero_ambitos"/>

                <x-label class='mt-4'>Representante Economico</x-label>
                <x-select wire:model="hogarForm.representante_economico" class='w-full' >
                	<option value="" selected >Seleccione</option>
                	<option value="Padre" >Padre</option>
                	<option value="Madre" >Madre</option>
                	<option value="Ambos" >Ambos</option>
                	<option value="Otro" >Otro</option>
                </x-select> 
                <x-input-error for="hogarForm.representante_economico"/>

                <x-label class='mt-4'>Gastos separados</x-label>
                <x-select wire:model="hogarForm.gastos_separados" class='w-full' >
                	<option value="" selected >Seleccione</option>
                	<option value="si" >sí</option>
                	<option value="no" >no</option>
                </x-select> 
                <x-input-error for="hogarForm.gastos_separados"/>
                    
                <x-label class='mt-4'>Numero de dormitorios</x-label>
                <x-input wire:model="hogarForm.numero_dormitorios" type="text" placeholder='Numero de Dormitorios' class='w-full mb-2'/>
                <x-input-error for="hogarForm.numero_dormitorios"/>
                        
	        </div>		
	    </div>          
	    <x-button class='mb-4'>      
	    	Registrar   
	    </x-button>	    
    </form>	
    
    @endif

</div>				    

<script type="text/javascript">
		
	function fillFormFields() {

    // Rellena los campos de texto con letras aleatorias
    const stringFields = document.querySelectorAll('.fill-string');
    	
    stringFields.forEach(field => {
        field.value = generateRandomString(10); // Genera una cadena de 10 caracteres
    });	

    // Rellena los campos numéricos con números aleatorios
    const numberFields = document.querySelectorAll('.fill-number');
    numberFields.forEach(field => {
        field.value = Math.floor(Math.random() * 1000); // Número entre 0 y 999
    });

    // Rellena los campos de fecha con una fecha aleatoria
    const dateFields = document.querySelectorAll('.fill-date');
    dateFields.forEach(field => {
        field.value = generateRandomDate(); // Fecha en formato 'YYYY-MM-DD'
    });		
}			
			
// Genera una cadena aleatoria de letras
function generateRandomString(length) {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    let result = '';
    for (let i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return result;
}

// Genera una fecha aleatoria en formato 'YYYY-MM-DD'
function generateRandomDate() {
    const start = new Date(2000, 0, 1); // Fecha inicial (1 de enero de 2000)
    const end = new Date(); // Fecha actual
    const randomDate = new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime()));
    return randomDate.toISOString().split('T')[0];
}			
			
// Llamar a la función para rellenar los campos

window.addEventListener('fillFormRegistrarEstudiante', event => {
    fillFormFields();
});

</script>	