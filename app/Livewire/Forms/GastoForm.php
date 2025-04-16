<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Gasto;

class GastoForm extends Form
{
    public $id;
    public $descripcion;
    public $cantidad;
    public $forma;
    public $dolar;

    public function guardar()
    { 
        $this->dolar = $this->dolar ?? 1; 

        $this->validate();

        if(empty($this->id)){
            Gasto::create($this->all());
        }
        else{
            Gasto::findOrFail($this->id)->update($this->all());    
        }
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
            'forma' => 'required|in:Divisa,Transferencia,Efectivo',
            'dolar' => 'nullable|numeric|between:0.1,10000|required_if:forma,Divisa',];
    }

    private function validatedData()
    {
        return $this->validate($this->rules());
    }
}
