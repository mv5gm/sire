<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Representante;

class RepresentanteEditarForm extends Form
{
    public $id;
    public $cedula;
    public $nombre;
    public $segundo;
    public $paterno;
    public $materno;
    public $direccion;

    public function editar($id){

    	$this->id = $id;

        $item = Representante::find($id);

        $this->cedula = $item->cedula;
        $this->nombre = $item->nombre;
        $this->segundo = $item->segundo;
        $this->paterno = $item->paterno;
        $this->materno = $item->materno;
        $this->direccion = $item->direccion;
    }		

    public function actualizar(){

		$item = Representante::find($this->id);

        $item->update($this->all());

        $this->reset();
	        
    }
    public function rules(){
        return [
            'cedula' =>'required|unique:estudiantes,cedula|integer|min:1000000|max:100000000',
            'nombre' =>'required|min:3|max:255',
            'segundo' =>'required|min:3|max:255',
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