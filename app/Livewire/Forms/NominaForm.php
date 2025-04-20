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
    public $cantidad;
    public $tipo;
    public $forma;
    public $quincena;

    public $open = false;
    public $openEliminar = false;

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
    
    public function guardarNomina($cantidades,$frecuencia,$mes,$anio,$quincena){
        
        $quincena = $frecuencia == 1 ? null : $quincena;

        dd($cantidades);

        foreach($cantidades as $key => $cantidad){
            Nomina::create([
                'mes' => $this->mes,
                'anio' => $this->anio,
                'empleado_id' => $key,
                'cantidad' => $cantidad,
                'quincena' => $quincena,
                'tipo' => $frecuencia,
            ]);
        }
    }

    public function rules(){
        return [
        'mes' => 'required|integer|min:1|max:12',
        'anio' => 'required|integer|min:2000|max:3100',
        'horas' => 'nullable|integer|min:1|max:1000|required_if:tipo,Docente',
        'matricula' => 'nullable|integer|min:1|max:1000|required_if:tipo,Matricula',
        'empleado_id' => 'required|exists:empleados,id',
        'forma' =>'required|in:Divisa,Transferencia,Efectivo',
        'tipo' =>'required|in:Quincenal,Mensual',
        'quincena' =>'nullable|in:Primera,Segunda',
        'cantidad' =>'required|decimal:0,2',
        ];
    }
    public function validationAttributes(){
        return [
            'mes' => 'Mes',
            'anio' => 'Año',
            'horas' => 'Horas',
            'matricula' => 'Matricula',
            'empleado_id' => 'Empleado',
            'forma' => 'Forma de Pago',
            'tipo' => 'Tipo de Nomina',
        ];
    }    
}           