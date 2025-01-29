<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;
use App\Models\Pago;
use App\Models\Representante;

class PagoRegistrar extends Form
{
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
