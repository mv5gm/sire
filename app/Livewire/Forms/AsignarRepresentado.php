<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class AsignarRepresentado extends Form
{
    public $id;
    public $representante_id;
    public $estudiante_id;
    public $parentesco;
    public $relacion;

    public function guardar($id = null)
    {
        $this->validate();

        if($id){
            $representado = Representado::find($id)->update($this->all());
        }           
        else{   
            $representado = Representado::create($this->all());     
        }       
        return $representado;
    }
    public function rules()
    {
        return [
            'estudiante_id' => 'required|integer|exists:estudiantes,id',
            'representante_id' => 'required|integer|exists:representantes,id',
            'parentesco' => 'required|string|max:255',
            'relacion' => 'required|string|max:255',
        ];  
    }   
}
