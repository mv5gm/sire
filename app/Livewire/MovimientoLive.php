<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class MovimientoLive extends Component
{
    public $divisas = [];
    public $transferencias = [];
    public $efectivos = [];
    public $activa = 'divisa'; // Pestaña activa por defecto

    public function mount(){
        $this->divisas = $this->obtenerMovimientos('Divisa');
        $this->transferencias = $this->obtenerMovimientos('Transferencia');
        $this->efectivos = $this->obtenerMovimientos('Efectivo');
    }
    public function render()
    {
        return view('livewire.movimiento-live');
    }
    public function obtenerMovimientos($forma)
    {
        $ingresos = DB::table('ingresos')->where('forma', $forma)
            ->select(
                'id',
                'cantidad',
                'forma',
                'created_at',
                DB::raw("'Ingreso' as tipo")
            );

        $gastos = DB::table('gastos')->where('forma', $forma)
            ->select(
                'id',
                'cantidad',
                'forma',
                'created_at',
                DB::raw("'Gasto' as tipo")
            );

        $nominas = DB::table('nominas')->where('forma', $forma)
            ->select(
                'id',
                'cantidad',
                'forma',
                'created_at',
                DB::raw("'Nomina' as tipo")
            );

        $movimientos = $ingresos
            ->union($gastos)
            ->union($nominas);

        // Agregar el campo `posicion` acumulativo respetando el orden descendente
        $movimientosConPosicion = [];
            
        $posicion = 0;

        foreach($movimientos->orderBy('created_at', 'asc')->orderBy('id', 'asc')->get() as $index => $movimiento) {
            
            if($movimiento->tipo == 'Ingreso'){
                $posicion += $movimiento->cantidad;
            }
            else{
                $posicion -= $movimiento->cantidad;
            }

            $movimientoConPosicion = new \stdClass();
            
            $movimientoConPosicion->id = $movimiento->id;
            $movimientoConPosicion->cantidad = $movimiento->cantidad;
            $movimientoConPosicion->posicion = $posicion;
            $movimientoConPosicion->forma = $movimiento->forma;
            $movimientoConPosicion->tipo = $movimiento->tipo;
            $movimientoConPosicion->created_at = $movimiento->created_at;

            $movimientosConPosicion[] = $movimientoConPosicion;
        }

        usort($movimientosConPosicion, function ($a, $b) {
            $dateComparison = strtotime($b->created_at) <=> strtotime($a->created_at);
            if ($dateComparison === 0) {
            return $b->id <=> $a->id;
            }
            return $dateComparison;
        });

        return $movimientosConPosicion;
    }
}
