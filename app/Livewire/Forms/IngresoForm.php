<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Ingreso;
use App\Models\Pago;
use App\Models\PagoMes;
	
class IngresoForm extends Form
{	
	public $id;
    public $cantidad;
	public $dolar;
	public $fecha;
	public $forma;
	public $codigo;
	public $descripcion;
    public $formas = ['Divisa','Transferencia','Efectivo'];

    public $tiposPago = ['Mensualidad','Uniformes','Aranceles'];

    // Opciones para los meses
    public $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    		
    public function rules(){
    		
    	return [
	    	'cantidad' => 'required|numeric|min:1',
	    	'dolar' => 'nullable|required_if:forma,Transferencia,Efectivo|numeric|min:1',
	    	'fecha' => 'nullable|date',
	    	'forma' => 'required|in:Efectivo,Transferencia,Divisa',
	    	'codigo' => 'required_if:forma,Transferencia|nullable|max:255',
	    	'descripcion' => 'nullable|max:255',
    	];		
    }		

    public function guardar(){
    	
    	$itemData = [
    		'cantidad' => $this->cantidad,
			'dolar' => $this->dolar,
			'forma' => $this->forma,
			'codigo' => $this->codigo,
			'descripcion' => $this->descripcion,
			'fecha' => $this->fecha,
    	];		

    	if (!empty($this->id)) {
    		$item = Ingreso::find($this->id);
    		
            $item->update($itemData);	
    	}		
    	else{	
    		$item = Ingreso::create($itemData);			
    	}			
        $this->id = null;
        $this->reset();

        return $item;
    }				

    // Cargar datos para editar
    public function editar($id)
    {			
        $item = Ingreso::find($id);

        $this->fill($item->toArray());

        return $item;
    }						
}				