<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Cursa;
use App\Models\Hogar;
use App\Models\Representante;
use App\Models\Representado;
use App\Models\Estudiante;
use App\Models\Empleado;
use App\Models\Nivel;
use App\Models\Pago;
use App\Models\Inscripcion;
use App\Models\User;
use App\Models\Ingreso;
use App\Models\Nomina;
use App\Livewire\CursaLive;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/pruebas', function () {

    phpinfo();

    $empleado = Empleado::find(7);
    
    //return $empleado->calcularSueldoMaestro(10,5);

    function obtenerMovimientos($forma)
    {
        $ingresos = DB::table('ingresos')->where('forma', $forma)
            ->select(
                'id',
                'cantidad',
                'forma',
                'created_at',
                DB::raw("'Ingreso' as tipo"),
                DB::raw("'ingresos' as origen")
            );

        $gastos = DB::table('gastos')->where('forma', $forma)
            ->select(
                'id',
                'cantidad',
                'forma',
                'created_at',
                DB::raw("'Gasto' as tipo"),
                DB::raw("'gastos' as origen")
            );

        $nominas = DB::table('nominas')->where('forma', $forma)
            ->select(
                'id',
                'cantidad',
                DB::raw("'Transferencia' as forma"),
                'created_at',
                DB::raw("'Nomina' as tipo"),
                DB::raw("'nominas' as origen")
            );

        $movimientos = $ingresos
            ->union($gastos)
            ->union($nominas);

        // Agregar el campo `posicion` acumulativo respetando el orden descendente
        $movimientosConPosicion = [];
            
        $posicion = 0;

        foreach($movimientos->orderBy('created_at', 'desc')->get() as $index => $movimiento) {
            
            $posicion += ($movimiento->tipo == 'Ingreso') ? $movimiento->cantidad : -$movimiento->cantidad;
            $movimientoConPosicion = new \stdClass();
            
            $movimientoConPosicion->id = $movimiento->id;
            $movimientoConPosicion->cantidad = $movimiento->cantidad;
            $movimientoConPosicion->posicion = $posicion;
            $movimientoConPosicion->forma = $movimiento->forma;
            $movimientoConPosicion->tipo = $movimiento->tipo;
            $movimientoConPosicion->created_at = $movimiento->created_at;

            $movimientosConPosicion[] = $movimientoConPosicion;
        }

        return $movimientosConPosicion;
    }
    return obtenerMovimientos('Divisa');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        
        $ingresosPorMes = Ingreso::PorMes();

        $meses = $ingresosPorMes['meses'];
        $cantidades = $ingresosPorMes['cantidades'];

        return view('dashboard',compact('meses'))->with('cantidades',$cantidades);
    })->name('dashboard');
});

Route::get('/descargar-nomina', function () {
    $filePath = public_path('nomina.txt');
    if (file_exists($filePath)) {
        return response()->download($filePath)->deleteFileAfterSend(false);
    } else {
        abort(404, 'El archivo no existe.');
    }
})->name('descargar.nomina');

Route::resource('estudiantes',App\Http\Controllers\EstudianteController::class)->middleware(['auth','can:estudiantes.index']);

Route::resource('representantes',App\Http\Controllers\RepresentanteController::class)->middleware(['auth', 'can:representantes.index']);
        
Route::resource('pagos',App\Http\Controllers\PagoController::class)->middleware(['auth','can:pagos.index']);

Route::resource('ingresos',App\Http\Controllers\IngresoController::class)->middleware(['auth','can:ingresos.index']);
        
Route::resource('empleados',App\Http\Controllers\EmpleadoController::class)->middleware(['auth','can:empleados.index']);

Route::resource('nominas',App\Http\Controllers\NominaController::class)->middleware(['auth','can:empleados.index']);
        
Route::resource('plan',App\Http\Controllers\CursaController::class)->middleware(['auth','can:plan.index']);

Route::resource('gastos',App\Http\Controllers\GastoController::class)->middleware(['auth','can:gastos.index']);

Route::resource('users',App\Http\Controllers\UserController::class)->middleware(['auth','can:users.index']);

Route::resource('roles',App\Http\Controllers\RoleController::class)->middleware(['auth','can:users.index']);
        
//Route::get('/plan',[CursaLive::class]);

Route::get('export',[App\Http\Controllers\ExportController::class,'excel'])->name('export')->middleware(['auth','can:estudiantes.index' ]);
        
Route::get('reportePagos/{estudiante_id}/{representante_id}/{aescolar}/{tipo}',[App\Http\Controllers\PagoController::class,'reporte'])->name('reportes.pagos')->middleware(['auth','can:estudiantes.index' ]);

Route::get('movimientos',function(){
    
    return view('movimientos');

})->name('movimientos')->middleware(['auth','can:gastos.index']);