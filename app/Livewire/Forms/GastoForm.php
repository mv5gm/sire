<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Gasto;

class GastoForm extends Form
{
    public $id;
    public $descripcion;
    public $cantidad;
    public $tipo;
    public $dolar;

    public function guardar()
    {
        if(empty($this->id)){
            Gasto::create($this->validatedData());
        }
        else{
            Gasto::findOrFail($this->id)->update($this->validatedData());    
        }
    }

    public function actualizar()
    {
        $gasto = Gasto::findOrFail($this->id);
        $gasto->update($this->validatedData());
    }

    public function editar($id)
    {
        $gasto = Gasto::findOrFail($id);
        $this->fill($gasto->toArray());
    }

    public function rules()
    {
        return [
            'descripcion' => 'required|string|min:3|max:100',
            'cantidad' => 'required|decimal:0,2|numeric|between:0.1,10000',
            'tipo' => 'required|in:Dolares,Bolivares',
            'dolar' => 'required_if:tipo,Dolares|numeric|between:0.1,10000',
        ];
    }

    private function validatedData()
    {
        return $this->validate($this->rules());
    }
}
