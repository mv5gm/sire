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
	public $formas = ['Efectivo','Transferencia','Divisa'];
	public $codigo;
	public $descripcion;
    public $esPago = false;
    public $estudiante_id;
    public $representante_id;
    public $tipoPago;
    public $mesesSeleccionados = [];

    public $tiposPago = ['Mensualidad','Uniformes','Aranceles'];

    // Opciones para los meses
    public $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    		
    public function rules(){
    		
    	return [
	    	'cantidad' => 'required|numeric|min:1',
	    	'dolar' => 'required|numeric|min:1',
	    	'forma' => 'required|in:Efectivo,Transferencia,Divisa',
	    	'codigo' => 'required_if:forma,Transferencia|nullable|max:255',
	    	'descripcion' => 'nullable|max:255',
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
			'descripcion' => $this->descripcion,
			'fecha' => date('Y-m-d'),
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

            //dd($this->estudiante_id);

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

        $item->load('pagos.pagosMeses');
        
        $this->cantidad = $item->cantidad;
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
            $this->mesesSeleccionados = $pago->pagosMeses->pluck('mes')->toArray();
        }		
    }						
}				