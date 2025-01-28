<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sire</title>

        <link rel="shortcut icon" href="/img/sire-icono.ico" />

        <!-- Fonts -->

        <style type="text/css">
            *{
                padding: 0px;
                margin: 0px;
                box-sizing: border-box;
            }   
            @media print{
                body{
                    writing-mode: rl;
                    margin: 2cm;
                }   
                @page { 
                    margin: 0; 
                }
            }       
            .tabla td{ 
                border: 1px solid #f5f5f5;
                padding:10px;
                font-size: 13px; 
                break-inside: auto;
            }
            .tabla tbody tr:nth-child(2n+1){
                background: #f5f5f5;
            }
            .form input , .form label ,.form select{
                font-size: 13px;
            }
            .main{
                height: 820px;
                width: 1024px;
                transform:;
            }
            body{
                height: 820px;
                width: 1024px;
            }
            .portada, .contenido{
                padding: 20px;
                width: 512px;
                transform:;
            }
            .portada{
                font-size: 18px !important;
                padding: 40px !important;
                height: 720px;
            }
            .contenido{
                
            }
            .pago{
                height:180px;
                font-weight: bold;
                border:2px solid #000;
                font-size: 20px !important;
            }       
            .mes{   
                text-align:center;
                font-weight: bold;
                font-size: 18px !important;
            }
            h1{
                font-size: 30px;
            }   
        </style>
    </head> 
    <body>  

    @php    
        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            
        $pag = array_chunk($pagos->toArray(),4);

        $pag[2] = $pag[2] ?? [];
        $pag[1] = $pag[1] ?? [];
        $pag[0] = $pag[0] ?? [];

    @endphp        

            <!-- Page Content -->
        <main class="main">
            <table>
                <tr>
                    <td>
                        <div class="contenido">
                            
            @forelse($pag[2] as $key)
                <div class="pago">
                    
                    <P class='mes'>{{$meses[intval(substr($key['fecha'],5,2))-1]}}    SELLO</P>
                    
                    <P>Cantidad: {{$key['cantidad']}} $</P>
                    <P>Precio del Dolar: {{$key['dolar']}} Bs</P>
                    <P>Forma de pago: {{$key['forma']}} </P>
                    <P>Tipo de pago: {{$key['tipo']}}</P>
                    <P>Precio en Bs: {{$key['cantidad']*$key['dolar']}} </P>
                </div>
                <hr>
            
            @empty
                <p>No hay pagos desde Septiembre Hasta Diciembre</p>
            @endforelse

                        </div>            
                    </td>
                    <td>
                    
                        <div class="portada">
                <center>
                    <p>
                        <b>
                        REPUBLICA BOLIVARIAN DE VENEZUELA <br>
                        MINISTERIO DEL PPP LA EDUCACION <br>
                        U.E.P. "GRAN MARISCAL DE AYACUCHO" <br>
                        YAGUARAPARO ESTADO SUCRE <br>
                        CODIGO DEL PLANTEL PD 15871907 <br>
                        MUNICIPIO CAJIGAL - ESTADO SUCRE <br>
                        </b>
                    </p> 
                        <br><br>

                        <img src="/img/UEPGMA.png" width="100" height="100">

                        <br><br>
                    <h1> 
                        <b> CERTIFICACION DE PAGO </b>
                    </h1>   
                        <br><br>                    
                </center>
                    <b>
                    
                    <p>Nombre de estudiante: {{ strtoupper( $estudiante->estudiante->nombre.' '.$estudiante->estudiante->paterno) }}</p>    
                    <p>GRADO: {{$estudiante->cursa->nivel->nombre}} SECCION: {{$estudiante->cursa->seccion->nombre}} </p>    
                    <p>Nombre del representante: {{ strtoupper($representante->nombre.' '.$representante->paterno ) }}</p>    
                    <p>TOMO:</p>    
                    <p>NUMERO:</p>    
                    <p>AÑO ESCOLAR: {{$aescolar->inicio}}- {{$aescolar->final}}</p>    
                    
                    </b>    
                        </div>

                    </td>
                </tr>
                <tr>
                    <td>
                        <br><br><br>
                    </td>
                    <td>
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="contenido">
                            
            @forelse($pag[0] as $key)
                <div class="pago">
                    <P class='mes'>{{$meses[intval(substr($key['fecha'],5,2))-1]}}    SELLO</P>

                    <P>Cantidad: {{$key['cantidad']}} $</P>
                    <P>Precio del Dolar: {{$key['dolar']}} Bs</P>
                    <P>Forma de pago: {{$key['forma']}} </P>
                    <P>Tipo de pago: {{$key['tipo']}}</P>
                    <P>Precio en Bs: {{$key['cantidad']*$key['dolar']}} </P>
                </div>
                <hr>

            @empty  
                <p>No hay pagos desde Enero hasta Abril</p>
            @endforelse

                        </div>
                    </td>
                    <td>
                        <div class="contenido">
                            
            @forelse($pag[1] as $key)
                <div class="pago">
                    <P class='mes'>{{$meses[intval(substr($key['fecha'],5,2))-1]}}    SELLO</P>

                    <P>Cantidad: {{$key['cantidad']}} $</P>
                    <P>Precio del Dolar: {{$key['dolar']}} Bs</P>
                    <P>Forma de pago: {{$key['forma']}} </P>
                    <P>Tipo de pago: {{$key['tipo']}}</P>
                    <P>Precio en Bs: {{$key['cantidad']*$key['dolar']}} </P>
                </div>
                <hr>

            @empty
                <p>No hay pagos desde Mayo hasta Agosto</p>
            @endforelse

                        </div>
                    </td>
                </tr>
            </table>
        </main>
    </body>
</html>
<script type="text/javascript">
    window.print();
    //window.location = "/pagos/";
</script>