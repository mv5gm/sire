<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;
use App\Models\Pago;
use App\Models\Representante;
	
class PagoForm extends Form
{
    public $id;
    public $representante_id;
    public $cantidad;
    public $dolar;
    public $fecha;
    public $tipo;
    public $forma;
    public $codigo;

    public function guardar(){

        $pago = Pago::create([
        	'cantidad' => $this->cantidad,
        	'dolar' => $this->dolar,
        	'fecha' => $this->fecha,
        	'forma' => $this->forma,
            'representante_id' => $this->representante_id,
            'tipo' => $this->tipo,
            'codigo' => $this->codigo
        ]);

        return $pago;

        //Pago::create($this->all());
    }	
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
            'representante_id' =>'required|exists:representantes,id',
            'cantidad' =>'required|decimal:0,2|min:1|max:1000000',
            'dolar' =>'required|decimal:0,2|min:1|max:1000000',
            'fecha' =>'required|date',
            'forma' =>'required|in:Efectivo,Transferencia,Divisa',
            'tipo' =>'required|in:Uniformes,Aranceles,Mensualidad',
            'codigo' =>$val
        ];  
    }
    public function validationAttributes(){
        return [
            'tipo' => 'Tipo de pago',
            'forma' => 'Forma de Pago'
        ];
    }
}