<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class inscripcionForm extends Form
{
    public $id;
    public $estudiante_id;
    public $cursa_id;
    public $tipo;

    public function guardar(){
        
        $this->validate();

        return Inscripcion::createOrUpdate($this->all());
    }
    public function rules()
    {
        return [
            'estudiante_id' => 'required|integer|exists:estudiantes,id',
            'cursa_id' => 'required|integer|exists:cursos,id',
            'tipo' => 'required|string|max:255',
        ];
    }
}
