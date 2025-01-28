<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Pago;

class imprimirPago extends Form
{
    public $tipo;
    public $aescolar;
    public $representante_id;
    public $estudiante_id;

    public function guardar(){

    	return redirect()->route('reportes.pagos',[$this->estudiante_id,$this->representante_id,$this->aescolar,$this->tipo]);
    }
    public function rules(){
        return [
            'tipo' =>'required|in:Aranceles,Matricula,Uniformes',
            'aescolar' =>'required|exists:aescolars,id',
            'representante_id'=>'required|exists:representantes,id',
            'estudiante_id'=>'required|exists:estudiantes,id'
        ];  
    }
    public function validationAttributes(){
        return [
            'tipo' => 'Tipo de pago',
            'aesolar' => 'Año escolar',
            'representante_id' => 'Representante',
            'estudiante_id' => 'Estudiante'
        ];
    }      
}