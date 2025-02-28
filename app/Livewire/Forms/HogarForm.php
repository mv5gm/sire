<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Hogar;

class HogarForm extends Form
{
    public $numero_mayores;
    public $numero_menores;
    public $numero_familias;
    public $numero_ambitos;
    public $representante_economico;
    public $gastos_separados;
    public $numero_dormitorios;

    public function guardar(){
        return Hogar::createOrUpdate($this->all());
    }
    public function rules()
    {
        return [
            'numero_mayores' => 'required|integer|min:0',
            'numero_menores' => 'required|integer|min:0',
            'numero_familias' => 'required|integer|min:0',
            'numero_ambitos' => 'required|integer|min:0',
            'representante_economico' => 'required|in:Padre,Madre,Ambos,Otro',
            'gastos_separados' => 'required|in:si,no',
            'numero_dormitorios' => 'required|integer|min:0',
        ];
    }
}
