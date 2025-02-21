<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Ingreso;
use App\Models\Pago;
use App\Models\PagoMes;
	
class IngresoForm extends Form
{	
	public $cantidad;
	public $dolar;
	public $forma;
    public $esPago = false;
    public $estudiante_id;
    public $representante_id;
    public $tipoPago;
    public $mesesSeleccionados = [];

    public $tiposPago = ['Mensualidad','Uniformes','Aranceles'];

    // Opciones para los meses
    public $meses = ['Enero'=>1, 'Febrero'=>2, 'Marzo'=>3, 'Abril'=>4, 'Mayo'=>5, 'Junio'=>6,'Julio'=>7, 'Agosto'=>8, 'Septiembre'=>9, 'Octubre'=>10, 'Noviembre'=>11, 'Diciembre'=>12];
    		
    public function rules(){
    		
    	return [
	    	'cantidad' => 'required|numeric|min:1',
	    	'dolar' => 'required|numeric|min:1',
	    	'forma' => 'required|in:Efectivo,transferencia,Divisa',
	    	'codigo' => 'numeric|max:255',
	    	'descripcion' => 'max:255',
	    	'esPago' => 'boolean',
	    	'estudiante_id' => 'required_if:esPago,true',
	    	'representante_id' => 'required_if:esPago,true',
	    	'tipoPago' => 'required_if:esPago,true',
	    	'mesesSeleccionados' => 'required_if:tipoPago,Mensualidad',
    	];		
    }		

    public function save($id = null){
    	$this->validate();
    	
    	$itemData = [
    		'cantidad' => $this->cantidad,
			'dolar' => $this->dolar,
			'forma' => $this->forma,
			'codigo' => $this->codigo,
			'descripcion' => $this->descripcion
    	];		

    	if ($id) {
    		$item = Ingreso::find($id);
    		$item->update($itemData);	
    	}		
    	else{	
    		$item = Ingreso::create($itemData);			
    	}			
    	// Si es un pago, crear o actualizar el pago
        if ($this->esPago) {
            $pagoData = [
                'ingreso_id' => $item->id,
                'estudiante_id' => $this->estudiante_id,
                'representante_id' => $this->representante_id,
                'tipo' => $this->tipoPago,
            ];	

            if ($id) {
                $pago = Pago::where('ingreso_id', $item->id)->first();
                $pago->update($pagoData);
            } else {
                $pago = Pago::create($pagoData);
            }	

            // Si es mensualidad, actualizar los meses
            if ($this->tipoPago === 'Mensualidad') {
                PagoMes::where('pago_id', $pago->id)->delete(); // Eliminar meses anteriores
                foreach ($this->mesesSeleccionados as $mes) {
                    PagoMes::create([	
                        'pago_id' => $pago->id,
                        'mes' => $mes,	
                        'anio'=> date('Y'),
                    ]);	
                }		
            }		
        }			
    }				

    // Cargar datos para editar
    public function load($id)
    {			
        $item = Ingreso::find($id);
        $this->cantidad = $ingreso->cantidad;
        $this->dolar = $item->dolar;
        $this->fecha = $item->fecha;
        $this->forma = $item->forma;
        $this->codigo = $item->codigo;
        $this->descripcion = $item->descripcion;

        if ($item->pagos->count() > 0) {
            $pago = $item->pagos->first();
            $this->esPago = true;
            $this->estudiante_id = $pago->estudiante_id;
            $this->representante_id = $pago->representante_id;
            $this->tipoPago = $pago->tipo;
            $this->mesesSeleccionados = $pago->pagoMeses->pluck('mes')->toArray();
        }		
    }						
}				