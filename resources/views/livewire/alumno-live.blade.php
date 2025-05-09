<div>

    <div class='flex py-3 border-bottom'>
        <h1 class="text-2xl font-bold">Estadisticas Estudiantiles</h1>
    </div>

    <h3 class='py-3'>Total estudiantes: {{$totalEstudiantes}} </h3>
    
    <h3 class='py-3'>Estudiantes por sexo</h3>
    
    <table class='border w-full'>
        <tbody class='bg-light border'>
            <tr>
                <td class='p-2'>Total estudiantes femeninos: {{$totalEstudiantesFemeninos}}</td>
                <td class='p-2'>Total estudiantes masculinos: {{$totalEstudiantesMasculinos}}</td>
            </tr>
        </tbody>
    </table>

    <h3 class='py-3'>Estudiantes por Nivel Academico</h3>
    
    <table class='border w-full'>
        <thead class='bg-light border'>
            <tr>
                <td class='p-2'>Nivel Academico</td>
                <td class='p-2'>Cantidad de estudiantes</td>
            </tr>
        </thead>
        <tbody>
            
            @forelse($estudiantesPorNivel as $key)                
                <tr>
                    <td class='p-2'> {{ $key->nivel }} </td>
                    <td class='p-2'> {{ $key->cantidad }} </td>
                </tr>
                @empty
                    <tr>
                        <td>Sin Resultados</td>
                    </tr>
            @endforelse
            
        </tbody>
    </table>

    <h3 class='py-3'>Estudiantes por Categoria Educativa</h3>
    
    <table class='border w-full'>
        <thead class='bg-light border'>
            <tr>
                <td class='p-2'>Categoria</td>
                <td class='p-2'>Cantidad de estudiantes</td>
            </tr>
        </thead>
        <tbody>
            
            @forelse($estudiantesPorCategoria as $key)                
                <tr>
                    <td class='p-2'> Educacion {{ $key->categoria }} </td>
                    <td class='p-2'> {{ $key->cantidad }} </td>
                </tr>
            @empty
                <tr>
                    <td>Sin Resultados</td>
                </tr>    
            @endforelse
        </tbody>
    </table>

    <h3 class='pb-2 pt-4'>Total Representantes: {{$totalRepresentantes}} </h3>

    <h3 class='py-3'>Representantes por Categoria Educativa</h3>
    
    <table class='border w-full'>
        <thead class='bg-light border'>
            <tr>
                <td class='p-2'>Categoria</td>
                <td class='p-2'>Cantidad de representantes</td>
            </tr>
        </thead>
        <tbody>
            
            @forelse($representantesPorCategoria as $key)                
                <tr>
                    <td class='p-2'> Educacion {{ $key->categoria }} </td>
                    <td class='p-2'> {{ $key->cantidad }} </td>
                </tr>
            @empty
                <tr>
                    <td>Sin Resultados</td>
                </tr>    
            @endforelse
        </tbody>
    </table>

</div>