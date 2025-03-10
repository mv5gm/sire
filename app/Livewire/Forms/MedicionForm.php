<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Medicion;

class MedicionForm extends Form
{
    public $id;
    public $talla;
    public $talla_camisa;
    public $talla_pantalon;
    public $talla_zapatos;
    public $peso;
    public $altura;
    public $estudiante_id;

    public function guardar(){
        
        $this->validate();

        return Medicion::createOrUpdate($this->all());

    }
    public function rules()
    {
        return [
            'talla' => 'required|string|max:255',
            'talla_camisa' => 'nullable|string|max:255',
            'talla_pantalon' => 'nullable|string|max:255',
            'talla_zapatos' => 'nullable|intger',
            'peso' => 'required|integer',
            'altura' => 'nullable|decimal:0,2',
            'estudiante_id' => 'required|integer|exists:estudiantes,id',
        ];
    }
}
