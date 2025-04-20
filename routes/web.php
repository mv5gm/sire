<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Cursa;
use App\Models\Hogar;
use App\Models\Representante;
use App\Models\Representado;
use App\Models\Estudiante;
use App\Models\Nivel;
use App\Models\Pago;
use App\Models\Inscripcion;
use App\Models\Empleado;
use App\Models\User;
use App\Models\Ingreso;
use App\Models\Nomina;
use App\Livewire\CursaLive;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/pruebas', function () {
    
    $buscar = '';
    $items = Nomina::with('empleado')
    ->whereHas('empleado', function ($query) {
        $buscar = '';
    $query->where('nombre', 'like', '%' . $buscar . '%');
    })
    ->orWhere('mes','like','%' . $buscar . '%')
    ->orWhere('anio','like','%' . $buscar . '%')
    ->get();

    return $items;

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
