<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use \App\Models\Representado;

class RepresentadoForm extends Form
{
    public $id; 
    public $estudiante_id; 
    public $representante_id; 
    public $hogar_id; 
    public $parentesco; 
    public $relacion;

    public function guardar()
    {           
        $this->validate();

        return Representado::createOrUpdate($this->all());
    }           
    public function rules()
    {       
        return [
            'estudiante_id' => 'required|integer|exists:estudiantes,id',
            'representante_id' => 'required|integer|exists:representantes,id',
            'parentesco' => 'required|string|max:255',
            'relacion' => 'required|string|max:255',
            'hogar_id' => 'required|exists:hogars,id',
        ];  
    }       
}           