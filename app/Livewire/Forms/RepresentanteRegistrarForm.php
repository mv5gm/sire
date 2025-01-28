<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;
use App\Models\Representante;

class RepresentanteRegistrarForm extends Form
{
    public $cedula;
    public $nombre;
    public $segundo;
    public $paterno;
    public $materno;
    public $direccion;

    public function guardar(){
        
        return Representante::create($this->all());
    }
    public function rules(){
        return [
            'cedula' =>'required|unique:representantes,cedula|integer|min:1000000|max:100000000',
            'nombre' =>'required|min:3|max:255',
            'segundo' =>'min:3|max:255',
            'paterno' =>'required|min:3|max:255',
            'materno' =>'required|min:3|max:255',
            'direccion' =>'required|min:3|max:255'
        ];  
    }
    public function validationAttributes(){
        return [
            'segundo' => 'segundo nombre',
            'paterno' => 'primer apellido',
            'materno' => 'segundo apellido'
        ];
    }
}
