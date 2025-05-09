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
    public $estudiante_id;
    public $ingreso_id;
    public $tipo;

    public function guardar(){

        $itemData = [
            'representante_id' => $this->representante_id,
            'estudiante_id' => $this->estudiante_id,
            'ingreso_id' => $this->ingreso_id,
            'tipo' => $this->tipo,
        ];

        if(!empty($this->id)){
            $item = Pago::find($this->id);

            $item->update($itemData);
            return $item;
        }    	

        $pago = Pago::create($itemData);

        return $pago;

        //Pago::create($this->all());
    }	
    public function editar($id){

    	$this->id = $id;

        $item = Pago::find($id);
        
        $this->fill($item->toArray());

        $this->reset();

        return $item;
    }		
    	
    public function rules(){
               
        return [
            'representante_id' =>'required|exists:representantes,id',
            'estudiante_id' =>'required|exists:estudiantes,id',
            'ingreso_id' =>'required|exists:ingresos,id',
            'tipo' =>'required|in:Uniformes,Aranceles,Mensualidad',
        ];  
    }
    public function validationAttributes(){
        return [
            'tipo' => 'Tipo de pago',
            'ingreso_id' => 'Ingreso',
            'representante_id' => 'Representante',
            'estudiante_id' => 'Estudiante',
        ];
    }
}