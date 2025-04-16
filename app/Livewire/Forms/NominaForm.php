<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Nomina;

class NominaForm extends Form
{
    public $id;
    public $mes;
    public $anio;
    public $horas;
    public $matricula;
    public $empleado_id;
    public $forma;

    public $open = false;
    public $openEliminar = false;

    public function registrar(){
        $this->id = null;
    }   
    public function editar($id){
        $this->id = $id;
        
        $item = Nomina::findOrFail($id);
        $this->fill($item->toArray());
    }
    public function guardar(){
        if(empty($this->id)){
            Nomina::create($this->all());
        }
        else{
            Nomina::findOrFail($this->id)->update($this->all());    
        }
    }   
    public function borrar($id){
        $this->id = $id;
        $this->openEliminar = true;
    }   
    public function eliminar(){
        Nomina::findOrFail($this->id)->delete();
        $this->openEliminar = false;

    }   

    public function rules(){
        return [
        'mes' => 'required|integer|min:1|max:12',
        'anio' => 'required|integer|min:2000|max:3100',
        'horas' => 'nullable|integer|min:1|max:1000|required_if:tipo,Docente',
        'matricula' => 'nullable|integer|min:1|max:1000|required_if:tipo,Matricula',
        'empleado_id' => 'required|exists:empleados,id',
        'forma' =>'required|in:Divisa,Transferencia,Efectivo'
        ];
    }
    public function validationAttributes(){
        return [
            'mes' => 'Mes',
            'anio' => 'Año',
            'horas' => 'Horas',
            'matricula' => 'Matricula',
            'empleado_id' => 'Empleado',
            'forma' => 'Forma de Pago'
        ];
    }    
}           