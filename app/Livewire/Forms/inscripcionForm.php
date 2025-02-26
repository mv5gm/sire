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
        
        if($this->id){
            $ins = Inscripcion::find($this->id)->update($this->all());
        }       
        else{   
            $ins = Inscripcion::create($this->all());
        }
        return $ins;
    }
}
