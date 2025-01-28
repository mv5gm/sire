<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;
use App\Models\Pago;
use App\Models\Representante;

class PagoEditar extends Form
{
    public $id;
    public $representante_id;
    public $estudiante_id;
    public $cantidad;
    public $dolar;
    public $fecha;
    public $forma;
    public $tipo;
    public $codigo;
    public $aescolar_id;

    public function editar($id){

    	$this->id = $id;

        $item = Pago::find($id);
        
        $this->estudiante_id = $item->estudiante_id;
        $this->representante_id = $item->representante_id;
        $this->cantidad = $item->cantidad;
        $this->dolar = $item->dolar;
        $this->fecha = $item->fecha;
        $this->forma = $item->forma;
        $this->tipo = $tipo;
        $this->codigo = $codigo;
        $this->aescolar_id = $item->aescolar_id;
    }		

    public function actualizar(){

		$item = Pago::find($this->id);

        $item->update([	
        	'cantidad' => $this->cantidad,
        	'dolar' => $this->dolar,
        	'fecha' => $this->fecha,
        	'forma' => $this->forma,
            'representante_id' => $this->representante_id,
        	'estudiante_id' => $this->estudiante_id,
            'tipo' => $this->tipo,
            'aescolar_id' => $this->aescolar_id,
        	'codigo' => $this->codigo,
        ]);	

        $this->reset();
	        
    }
    public function rules(){
        $val = '';
            
        if ($this->forma == 'Transferencia') {
            $val = 'required|min:4|max:4';    
        }

        return [
            'cedula' =>'required|exists:representantes,cedula',
            'cantidad' =>'required|decimal:0,2|min:3|max:1000000',
            'dolar' =>'required|decimal:0,2|min:3|max:1000000',
            'fecha' =>'required|date',
            'forma' =>'required|in:Efectivo,Transferencia,Divisa',
            'tipo' =>'required|in:Uniformes,Aranceles,Mensualidad',
            'codigo' => $val
        ];  
    }
    public function validationAttributes(){
        return [
            'tipo' => 'Tipo de pago',
            'cedula' => 'Cedula del representante',
            'forma' => 'Forma de pago'
        ];
    }	
}		