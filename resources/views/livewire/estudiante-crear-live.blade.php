<div>
	
	<span wire:loading>
		<i class='fa-solid fa-rotate fa-spin'></i>
	</span>
	
	<div class="{{ $mostrarFormulario ? '' : 'oculto' }}">
		<div class='flex'>
			<h1 class='flex-1'>Registrar Inscripcion</h1>
			<button wire:click='cerrarFormulario'><i class='fa-solid fa-xmark'></i></button>
		</div>		
		<form wire:submit='registrar'>
			<div class="flex flex-col md:flex-row gap-4 p-2">
				
			<!-- Datos Estudiante -->
				
				<div class="flex-1 p-2 rounded-lg shadow-md">
					<h1 class='text-center p-2 bg-light border-2'>Datos Estudiante</h1>
					<hr>

					<x-label class='mt-4'>Primer Nombre</x-label>
					<x-input wire:model.live="estudianteForm.nombre" type="text" placeholder='Primer Nombre' class='w-full fill-string' value='Xiana'/>
					<x-input-error for="estudianteForm.nombre"/>

					<x-label class='mt-4'>Segundo Nombre <small>(Opcional)</small></x-label>
					<x-input wire:model.live="estudianteForm.segundo" type="text" name="segundo" placeholder='Segundo Nombre' class='w-full'/>
					<x-input-error for="estudianteForm.segundo"/>

					<x-label class='mt-4'>Primer Apellido</x-label>
					<x-input wire:model.live="estudianteForm.paterno" type="text" name="paterno" placeholder='Primer Apellido' class='w-full fill-string' value='Liang' />
					<x-input-error for="estudianteForm.paterno"/>

					<x-label class='mt-4'>Segundo Apellido <small>(Opcional)</small></x-label>
					<x-input wire:model.live="estudianteForm.materno" type="text" name="materno" placeholder='Segundo Apellido' class='w-full' value='Lugo'/>
					<x-input-error for="estudianteForm.materno"/>

					<x-label class='mt-4'>Cedula <small>(Opcional)</small></x-label>
					<x-input wire:model.live='estudianteForm.cedula' type="text" placeholder='Cedula' class='w-full fill-number' title='Solo numeros'/>
					<x-input-error for="estudianteForm.cedula"/>

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
					
					<x-label class='mt-4'>Fecha de nacimiento</x-label>
					<x-input wire:model.live="estudianteForm.fecha" type="date" name="fecha" placeholder='Fecha de nacimiento' class='w-full fill-date'/>
					<x-input-error for="estudianteForm.fecha"/>

					<x-label class='mt-4'>Institucion de Procedencia <small>(Opcional)</small> </x-label>
					<x-input wire:model.live="estudianteForm.institucion_procedencia" type="text" placeholder='Institucion de Procedencia' class='w-full'/>
					<x-input-error for="estudianteForm.institucion_procedencia"/>

					<x-label class='mt-4'>Sexo</x-label>
					<x-select wire:model="estudianteForm.sexo" name="sexo" class='w-full form-control'>
						<option value="" disabled="">Seleccione</option>
						<option value="m">Masculino</option>
						<option value="f">Femenina</option>
					</x-select>
					<x-input-error for="estudianteForm.tipo"/>	
					
					<x-label class='mt-4'>Tipo de Estudiante</x-label>
					<x-select wire:model="estudianteForm.tipo" class='w-full form-control'>
						<option value="">Seleccione</option>
						<option value="Normal">Normal</option>
						<option value="Especial">Especial</option>
						<option value="Exonerado">Exonerado</option>
					</x-select>
					<x-input-error for="estudianteForm.tipo"/>	
					
				</div>
		
			<!-- Datos Representates -->
				
				<div class="flex-1 p-2 rounded-lg shadow-md">
					<h1 class="text-center p-2 bg-light border-2">Datos Representante Legal</h1>
					<hr>
					<div class='flex'>
						<x-label class='m-2'>
							<input type="radio" wire:click="mostrarRepresentanteRegistrado(false)" name='representanteRegistrado'>No registrado
						</x-label>
						<x-label class='m-2'>
							<input type="radio" wire:click="mostrarRepresentanteRegistrado(true)" name='representanteRegistrado'>Registrado
						</x-label>
					</div>    

					<div class="{{ !$representanteRegistrado ? '' : 'oculto' }}">

						<x-label class='mt-4'>Primer Nombre</x-label>
						<x-input wire:model="representanteForm.nombre" type="text"  placeholder='Primer Nombre del Representante' class='w-full' value='Zuleimyoli' />
						<x-input-error for="representanteForm.nombre"/>

						<x-label class='mt-4'>Segundo Nombre <small>(Opcional)</small></x-label>
						<x-input wire:model="representanteForm.segundo" type="text" name="segundo" placeholder='Segundo Nombre del Representante' class='w-full' value='Nicole' />
						<x-input-error for="representanteForm.segundo"/>

						<x-label class='mt-4'>Primer Apellido</x-label>
						<x-input wire:model="representanteForm.paterno" type="text" name="paterno" placeholder='Primer Apellido del Representante' class='w-full' value='Lugo'/>
						<x-input-error for="representanteForm.paterno"/>

						<x-label class='mt-4'>Segundo Apellido <small>(Opcional)</small></x-label>
						<x-input wire:model="representanteForm.materno" type="text" name="materno" placeholder='Segundo Apellido del Representante' class='w-full' value='Zorrilla'/>
						<x-input-error for="representanteForm.materno"/>

						<x-label class='mt-4'>Cedula</x-label>
						<x-input wire:model='representanteForm.cedula' type="number" min='1000000' max='1000000000' placeholder='Cedula del Representante' class='w-full' />
						<x-input-error for="representanteForm.cedula" value='28644181'/>

						<x-label class='mt-4'>Lugar de nacimiento</x-label>
						<x-input wire:model.live="representanteForm.lugar_nacimiento" type="text" placeholder='Lugar de Nacimiento' class='w-full' value='Carupano'/>
						<x-input-error for="representanteForm.lugar_nacimiento"/>

						<x-label class='mt-4'>Fecha de Nacimiento</x-label>
						<x-input wire:model="representanteForm.fecha" type="date" class='w-full'/>
						<x-input-error for="representanteForm.fecha"/>

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
						
						<x-label class='mt-4'>Nivel Academico</x-label>
							
						<x-select wire:model="representanteForm.nivel_academico" class='w-full mb-2' >
							<option value="">Seleccione</option>
							<option value="ninguno">Ninguno</option>
							<option value="primaria">Primaria</option>
							<option value="secundaria">Secundaria</option>
							<option value="universitario">Universitario</option>
						</x-select>
						
						<x-input-error for="representanteForm.nivel_academico" />

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

						<x-label class='mt-4'>Oficio / Profesion</x-label>
						<x-input wire:model.live="representanteForm.oficio" type="text" name="materno" placeholder='oficio del Representante' class='w-full' value='Comerciante'/>
						<x-input-error for="representanteForm.oficio"/>

						<x-label class='mt-4'>Condicion Laboral</x-label>
						<x-select wire:model='representanteForm.condicion_laboral' class='w-full'> >
							<option value="">Seleccione</option>
							<option value="Empleado(a)">Empleado(a)</option>
							<option value="Desempleado(a)">Desempleado(a)</option>
						</x-select>
						<x-input-error for="representanteForm.condicion_laboral"/>

						<x-label class='mt-4'>Nivel de Ingreso <small>(Opcional)</small></x-label>
						<x-input wire:model.live="representanteForm.nivel_ingreso" type="text" placeholder='Nivel de Ingreso' class='w-full' />
						<x-input-error for="representanteForm.nivel_ingreso"/>

						<x-label class='mt-4'>Direccion de Habitacion</x-label>
						<x-input wire:model.live="representanteForm.direccion_habitacion" type="text" placeholder='Direccion de Habitacion' class='w-full' value='Avenida Sucre Frente al Comando de la guardia Nacional' />
						<x-input-error for="representanteForm.direccion_habitacion"/>

						<x-label class='mt-4'>Direccion de Trabajo <small>(Opcional)</small></x-label>
						<x-input wire:model.live="representanteForm.direccion_trabajo" type="text" placeholder='Direccion de Trabajo' class='w-full' value='Calle Piar frente al Hospital de Yaguaraparo'/>
						<x-input-error for="representanteForm.direccion_trabajo"/>

						<x-label class='mt-4'>Telefono Local <small>(Opcional)</small></x-label>
						
						<x-input wire:model="representanteForm.telefono" type="text" placeholder='Telefono del Representante' class='w-full mb-2' minlength='11' maxlength='11' value='04248453799' />
						
						<x-input-error for="representanteForm.telefono" />

						<x-label class='mt-4'>Telefono Movil <small>(Opcional)</small></x-label>
						
						<x-input wire:model="representanteForm.telefono_movil" type="text" placeholder='Telefono Movil del Representante' class='w-full mb-2' minlength='11' maxlength='11' value='04248639877' />
						
						<x-input-error for="representanteForm.telefono_movil" />

						<x-label class='mt-4'>Correo <small>(Opcional)</small></x-label>
						
						<x-input wire:model="representanteForm.email" type="text" placeholder='Correo electronico' class='w-full mb-4' value='zuleimyolilugo@gmail.com' />
						
						<x-input-error for="representanteForm.email" />
					 
					</div>
					<div class="{{ $representanteRegistrado ? '' : 'oculto' }}">	
						<x-label > Seleccione un Representante </x-label>
						<div wire:ignore class='my-2'>	
							<select wire:model='representante_id' class='w-full select2'>
								<option value="">Seleccione</option>
								@foreach($representantes as $key)
									<option value='{{ $key->id }}'>{{ $key->nombre.' '.$key->paterno.' '.$key->cedula }}</option>
								@endforeach
							</select>
						</div>
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

					</div>	

					<h1 class='text-center p-2 bg-light border-2'>Datos Autorizado</h1>
					<hr>
					<div class='flex'>
						<x-label class='m-2'>
							<input type="radio" wire:click="mostrarAutorizadoRegistrado(false)" name='autorizadoRegistrado'>No registrado
						</x-label>
						<x-label class='m-2'>
							<input type="radio" wire:click="mostrarAutorizadoRegistrado(true)" name='autorizadoRegistrado'>Registrado
						</x-label>
					</div>

					<div class="{{!$autorizadoRegistrado? '' : 'oculto'}}">
						<x-label class='mt-4'>Primer Nombre</x-label>
						<x-input wire:model="representanteFormAutorizado.nombre" type="text"  placeholder='Primer Nombre del Representante' class='w-full' value='Wentian' />
						<x-input-error for="representanteFormAutorizado.nombre"/>

						<x-label class='mt-4'>Segundo Nombre <small>(Opcional)</small></x-label>
						<x-input wire:model="representanteFormAutorizado.segundo" type="text" name="segundo" placeholder='Segundo Nombre del Representante' class='w-full' />
						<x-input-error for="representanteFormAutorizado.segundo"/>

						<x-label class='mt-4'>Primer Apellido</x-label>
						<x-input wire:model="representanteFormAutorizado.paterno" type="text" name="paterno" placeholder='Primer Apellido del Representante' class='w-full' value='Liang' />
						<x-input-error for="representanteFormAutorizado.paterno"/>

						<x-label class='mt-4'>Segundo Apellido <small>(Opcional)</small></x-label>
						<x-input wire:model="representanteFormAutorizado.materno" type="text" name="materno" placeholder='Segundo Apellido del Representante' class='w-full'/>
						<x-input-error for="representanteFormAutorizado.materno"/>

						<x-label class='mt-4'>Cedula</x-label>
						<x-input wire:model='representanteFormAutorizado.cedula' type="number" min='1000000' max='1000000000' placeholder='Cedula del Representante' class='w-full' value='84420286'/>
						<x-input-error for="representanteFormAutorizado.cedula"/>

						<x-label class='mt-4'>Lugar de nacimiento</x-label>
						<x-input wire:model="representanteFormAutorizado.lugar_nacimiento" type="text" placeholder='Lugar de Nacimiento' class='w-full' value='China'/>
						<x-input-error for="representanteFormAutorizado.lugar_nacimiento"/>

						<x-label class='mt-4'>Fecha de Nacimiento</x-label>
						<x-input wire:model="representanteFormAutorizado.fecha" type="date" class='w-full'/>
						<x-input-error for="representanteFormAutorizado.fecha"/>

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

						<x-label class='mt-4'>Nivel Academico</x-label>
						<x-select wire:model="representanteFormAutorizado.nivel_academico" class='w-full mb-2' >
							<option value="">Seleccione</option>
							<option value="ninguno">Ninguno</option>
							<option value="primaria">Primaria</option>
							<option value="secundaria">Secundaria</option>
							<option value="universitario">Universitario</option>
						</x-select>
						<x-input-error for="representanteFormAutorizado.nivel_academico" />

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

						<x-label class='mt-4'>Oficio / Profesion</x-label>
						<x-input wire:model.live="representanteFormAutorizado.oficio" type="text" name="materno" placeholder='oficio del Representante' class='w-full' value='Comerciante'/>
						<x-input-error for="representanteFormAutorizado.oficio"/>	

						<x-label class='mt-4'>Condicion Laboral</x-label>
						<x-select wire:model='representanteFormAutorizado.condicion_laboral' class='w-full'> >
							<option value="">Seleccione</option>
							<option value="Empleado(a)">Empleado(a)</option>
							<option value="Desempleado(a)">Desempleado(a)</option>
						</x-select>
						<x-input-error for="representanteFormAutorizado.condicion_laboral"/>

						<x-label class='mt-4'>Nivel de Ingreso <small>(Opcional)</small></x-label>
						<x-input wire:model.live="representanteFormAutorizado.nivel_ingreso" type="text" placeholder='Nivel de Ingreso' class='w-full' />
						<x-input-error for="representanteFormAutorizado.nivel_ingreso"/>

						<x-label class='mt-4'>Direccion de Habitacion</x-label>
						<x-input wire:model.live="representanteFormAutorizado.direccion_habitacion" type="text" placeholder='Direccion de Habitacion' class='w-full' value='Avenida Sucre'/>
						<x-input-error for="representanteFormAutorizado.direccion_habitacion"/>

						<x-label class='mt-4'>Direccion de Trabajo <small>(Opcional)</small></x-label>
						<x-input wire:model.live="representanteFormAutorizado.direccion_trabajo" type="text" placeholder='Direccion de Trabajo' class='w-full' value='Calle Piar Frente al Hospital' />
						<x-input-error for="representanteFormAutorizado.direccion_trabajo"/>

						<x-label class='mt-4'>Telefono Local <small>(Opcional)</small></x-label>
						
						<x-input wire:model="representanteFormAutorizado.telefono" type="text" name="direccion" placeholder='Telefono del Representante' class='w-full mb-2' minlength='11' maxlength='11' value='04248639877' />
						
						<x-input-error for="representanteFormAutorizado.telefono" />

						<x-label class='mt-4'>Telefono Movil <small>(Opcional)</small></x-label>
						
						<x-input wire:model="representanteFormAutorizado.telefono_movil" type="text" name="direccion" placeholder='Telefono del Representante' class='w-full mb-2' minlength='11' maxlength='11' value='04248639877'/>
						
						<x-input-error for="representanteFormAutorizado.telefono_movil" />

						<x-label class='mt-4'>Correo <small>(Opcional)</small></x-label>
						
						<x-input wire:model="representanteFormAutorizado.email" type="text" placeholder='Correo electronico' class='w-full mb-4' />
						
						<x-input-error for="representanteFormAutorizado.email" />
					</div>
					
					<div class="{{ $autorizadoRegistrado ? '' : 'oculto' }}">	
						<x-label > Seleccione Representante </x-label>
						<div wire:ignore>	
							<x-select wire:model='autorizado_id' class='w-full mb-2 select2'>
								<option value="">Seleccione</option>
								@foreach($representantes as $key)
									<option value='{{ $key->id }}'>{{ $key->nombre.' '.$key->paterno.' '.$key->cedula }}</option>
								@endforeach
							</x-select>
						</div>
						<x-label class='mt-4'>Parentesco con el estudiante</x-label>
						<x-select wire:model.live="representadoFormAutorizado.parentesco" class='w-full mb-2'>
							<option value="" selected>Seleccione</option>        
							<option value="Madre" >Madre</option>        
							<option value="Padre">Padre</option>        
							<option value="Abuelo(a)">Abuelo(a)</option>        
							<option value="Tio(a)">Tio(a)</option>        
							<option value="Hermano(a)">Hermano(a)</option>        
							<option value="Primo(a)">Primo(a)</option>        
							<option value="Otro">Otro(a)</option>        
						</x-select>
					</div>

					<div class="{{ $mostrarSegundoAutorizado ? '' : 'oculto' }}">
						
						<h1 class='text-center p-2 bg-light border-2'>Datos Segundo Autorizado</h1>
						<hr/>
						<div class='flex'>
							<x-label class='m-2'>
								<input type="radio" wire:click="mostrarAutorizado2Registrado(false)" name='representanteRegistrado'>No registrado
							</x-label>
							<x-label class='m-2'>
								<input type="radio" wire:click="mostrarAutorizado2Registrado(true)" name='representanteRegistrado'>Registrado
							</x-label>
						</div>

						<div class="{{ !$autorizado2Registrado ? '' : 'oculto' }}">	                
							
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
							
							<x-label class='mt-4'>Cedula</x-label>
							<x-input wire:model='representanteFormAutorizado2.cedula' type="number" min='1000000' max='1000000000' placeholder='Cedula del Representante' class='w-full' />
							<x-input-error for="representanteFormAutorizado2.cedula"/>
							
							<x-label class='mt-4'>Lugar de nacimiento</x-label>
							<x-input wire:model="representanteFormAutorizado2.lugar_nacimiento" type="text" placeholder='Lugar de Nacimiento' class='w-full'/>
							<x-input-error for="representanteFormAutorizado2.lugar_nacimiento"/>

							<x-label class='mt-4'>Fecha de Nacimiento</x-label>
							<x-input wire:model="representanteFormAutorizado2.fecha" type="date" class='w-full'/>
							<x-input-error for="representanteFormAutorizado2.fecha"/>	

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

							<x-label class='mt-4'>Nivel Academico</x-label>
							
							<x-select wire:model="representanteFormAutorizado2.nivel_academico" class='w-full mb-2' >
								<option value="ninguno">Ninguno</option>
								<option value="primaria">Primaria</option>
								<option value="secundaria">Secundaria</option>
								<option value="universitario">Universitario</option>
							</x-select>

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

							<x-input-error for="representanteFormAutorizado2.nivel_academico" />

							<x-label class='mt-4'>Oficio / Profesion</x-label>
							<x-input wire:model="representanteFormAutorizado2.oficio" type="text" name="materno" placeholder='oficio del Representante' class='w-full'/>
							<x-input-error for="representanteFormAutorizado2.oficio"/>

							<x-label class='mt-4'>Condicion Laboral</x-label>
							<x-select wire:model='representanteFormAutorizado2.condicion_laboral' class='w-full'> >
								<option value="">Seleccione</option>
								<option value="Empleado(a)">Empleado(a)</option>
								<option value="Desempleado(a)">Desempleado(a)</option>
							</x-select>
							<x-input-error for="representanteFormAutorizado2.condicion_laboral"/>

							<x-label class='mt-4'>Nivel de Ingreso <small>(Opcional)</small></x-label>
							<x-input wire:model.live="representanteFormAutorizado2.nivel_ingreso" type="text" placeholder='Nivel de Ingreso' class='w-full' />
							<x-input-error for="representanteFormAutorizado2.nivel_ingreso"/>

							<x-label class='mt-4'>Direccion de Habitacion</x-label>
							<x-input wire:model="representanteFormAutorizado2.direccion_habitacion" type="text" placeholder='Direccion de Habitacion' class='w-full'/>
							<x-input-error for="representanteFormAutorizado2.direccion_habitacion"/>

							<x-label class='mt-4'>Direccion de Trabajo <small>(Opcional)</small></x-label>
							<x-input wire:model="representanteFormAutorizado2.direccion_trabajo" type="text" placeholder='Direccion de Trabajo' class='w-full'/>
							<x-input-error for="representanteFormAutorizado2.direccion_trabajo"/>

							<x-label class='mt-4'>Telefono fijo</x-label>
							
							<x-input wire:model="representanteFormAutorizado2.telefono" type="text" name="direccion" placeholder='Telefono del Representante' class='w-full mb-2' minlength='11' maxlength='11' />
							
							<x-input-error for="representanteFormAutorizado2.telefono" />

							<x-label class='mt-4'>Telefono Movil</x-label>
							
							<x-input wire:model="representanteFormAutorizado2.telefono_movil" type="text" placeholder='Telefono Movil del Representante' class='w-full mb-2' minlength='11' maxlength='11' />
							
							<x-input-error for="representanteFormAutorizado2.telefono_movil" />

							<x-label class='mt-4'>Correo</x-label>
						
							<x-input wire:model="representanteFormAutorizado2.email" type="text" placeholder='Correo electronico' class='w-full mb-4' />
							
							<x-input-error for="representanteFormAutorizado2.email" />
						</div>
						<div class="{{ $autorizado2Registrado ? '' : 'oculto' }}">
							
							<x-label > Seleccione Representante </x-label>
							<div wire:ignore>
								<x-select wire:model='autorizado2_id' class='w-full mb-2 select2'>
									<option value="">Seleccione</option>
									@foreach($representantes as $key)
										<option value='{{ $key->id }}'>{{ $key->nombre.' '.$key->paterno.' '.$key->cedula }}</option>
									@endforeach

								</x-select>
							</div>	
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

						</div>
					</div>
				</div> 	
						
			<!-- Datos Salud y Hogar -->
						
				<div class="flex-1 p-2 rounded-lg shadow-md">
						
					<h1 class='text-center p-2 bg-light border-2'>Datos Hogar</h1>
					<hr>

					<div class='flex'>
						<x-label class='m-2'>
							<input type="radio" wire:click="mostrarHogarRegistrado(false)" name='hogarRegistrado'>No registrado
						</x-label>
						<x-label class='m-2'>
							<input type="radio" wire:click="mostrarHogarRegistrado(true)" name='hogarRegistrado'>Registrado
						</x-label>
					</div>

					<div class="{{ !$hogarRegistrado ? '' : 'oculto' }}">
					
						<x-label class='mt-2'>Numero de personas que viven en el hogar</x-label>
						<x-input wire:model="hogarForm.numero_mayores" type="text" placeholder='Numero de Mayores de edad' class='w-full mb-2'/>
						<x-input-error for="hogarForm.numero_mayores"/>

						<x-input wire:model="hogarForm.numero_menores" type="text" placeholder='Numero de Menores de edad' class='w-full mb-2'/>
						<x-input-error for="hogarForm.numero_menores"/>

						<x-label class='mt-4'>Numero de Familias</x-label>
						<x-input wire:model="hogarForm.numero_familias" type="text" placeholder='Numero de Familias' class='w-full mb-2'/>
						<x-input-error for="hogarForm.numero_familias"/>

						<x-label class='mt-4'>Gastos separados</x-label>
						<x-select wire:model="hogarForm.gastos_separados" class='w-full' >
							<option value="" selected >Seleccione</option>
							<option value="si" >sí</option>
							<option value="no" >no</option>
						</x-select> 
						<x-input-error for="hogarForm.gastos_separados"/>

						<x-label class='mt-4'>Numero de ambientes</x-label>
						<x-input wire:model="hogarForm.numero_ambitos" type="text" placeholder='Numero de Ambientes' class='w-full mb-2'/>
						<x-input-error for="hogarForm.numero_ambitos"/>

						<x-label class='mt-4'>Numero de dormitorios</x-label>
						<x-input wire:model="hogarForm.numero_dormitorios" type="text" placeholder='Numero de Dormitorios' class='w-full mb-2'/>
						<x-input-error for="hogarForm.numero_dormitorios"/>

						<x-label class='mt-4'>Representante Economico</x-label>
						<x-select wire:model="hogarForm.representante_economico" class='w-full' >
							<option value="" selected >Seleccione</option>
							<option value="Padre" >Padre</option>
							<option value="Madre" >Madre</option>
							<option value="Ambos" >Ambos</option>
							<option value="Otro" >Otro</option>
						</x-select> 
						<x-input-error for="hogarForm.representante_economico"/>
				
						<x-label class='mt-4'>Telefono de emergencia</x-label>
							
						<x-input wire:model="hogarForm.telefono_emergencia" type="text" placeholder='Telefono de Emergencia' class='w-full mb-2' minlength='11' maxlength='11' value='04248377020' />
						
						<x-input-error for="hogarForm.telefono_emergencia" />
					</div>

					<div class="{{ $hogarRegistrado ? '' : 'oculto' }}">
						<x-label> Seleccione Hogar </x-label>
						<div wire:ignore>
							<x-select wire:model='hogar_id' class='w-full mb-2 select2'>
								<option value="">Seleccione</option>
								@foreach($hogares as $key)
									<option value='{{ $key->id }}'>
										{{$key->representados[0]->representante->nombre.' '.$key->representados[0]->representante->paterno.' '.$key->representados[0]->representante->cedula}}
									</option>
								@endforeach
							</x-select>
						</div>	
					</div>

					<x-label class='mt-4'>Vive con:</x-label>
						@foreach($estudianteForm->opcionesVive as $key)
							<label>
								<input type="checkbox" wire:model='estudianteForm.selectedVive' value='{{$key}}' >
								{{$key}}
							</label>
						@endforeach
					<x-input-error for="estudianteForm.vive_con"/>

					<h1 class='text-center p-2 bg-light mt-4 border-2'>Datos de Salud del estudiante</h1>
					<hr>

					<x-label class='mt-4'>Utiliza Lentes?</x-label>
					<x-select wire:model="estudianteForm.lentes" class='w-full' >
						<option value="" >Seleccione</option>
						<option value="si" >sí</option>
						<option value="no" >no</option>
					</x-select> 
					<x-input-error for="estudianteForm.lentes"/>

					<x-label class='mt-4'>Alergias</x-label>
					<x-select wire:model.live="estudianteForm.alergias" class='w-full' >
						<option value="ninguna">Ninguna</option>
						<option value="asma">Asma</option>
						<option value="respiratorias">Respiratorias</option>
						<option value="rinitis" selected>Rinitis</option>
					</x-select>
					<x-input-error for="estudianteForm.alergias"/>

					<x-label class='mt-4'>Tratamiento <small>(Opcional)</small></x-label>
					<x-input wire:model.live="estudianteForm.tratamiento" type="text" placeholder='Tratamiento' class='w-full'/>
					<x-input-error for="estudianteForm.tratamiento"/> 

					<x-label class='mt-4'>Tipo de parto</x-label>
					<x-select wire:model="estudianteForm.parto" class='w-full mb-2' >
						<option value="" >Seleccione</option>
						<option value="natural" >Natural</option>
						<option value="cesarea" >Cesarea</option>
					</x-select> 
					<x-input-error for="estudianteForm.parto"/>
					
					<x-label class='mt-4'>Talla</x-label>
					<x-input wire:model="medicionForm.talla" type="text" placeholder='Talla' class='w-full' value='6'/>
					<x-input-error for="medicionForm.talla"/>		

					<x-label class='mt-4 mb-4'>Peso</x-label>
					<x-input wire:model="medicionForm.peso" type="text" placeholder='Peso' class='w-full' value='10'/>
					<x-input-error for="medicionForm.peso"/>		
				
				<!-- datos de la inscripcion -->
					<h1 class='text-center p-2 bg-light mt-4 border-2'>Datos de inscripcion</h1>	
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

					<x-label class='mt-4'>Fecha de la Inscripcion</x-label>
							
					<x-input type='date' wire:model="inscripcionForm.fecha" class='w-full form-control'/>
						
					<x-input-error for="inscripcionForm.fecha"/>
				</div>
			</div>          
			<x-button class='mb-4'>      
				+ Registrar Inscripcion
			</x-button>	    
		</form>	
    </div>

	@section('scripts')
		<script>
			function initSelect2() {
				$('.select2').each(function() {
					let $select = $(this);

					if ($select.hasClass("select2-hidden-accessible")) {
						$select.select2('destroy');
					}

					$select.select2({
						width: '100%',
						placeholder: 'Seleccione',
						allowClear: true
					});

					let model = $select.attr('wire:model') || $select.attr('wire:model.defer');
					if (model) {
						$select.off('change').on('change', function (e) {
							@this.set(model, $(this).val());
						});

						// *** Esta línea es la clave ***
						setTimeout(() => {
							$select.val(@this.get(model)).trigger('change.select2');
						}, 50);
					}
				});
			}

			$(document).ready(function(){
				initSelect2();
			});

			Livewire.on('select2', () => {
				initSelect2();
			});
		</script>
	@endsection
</div>