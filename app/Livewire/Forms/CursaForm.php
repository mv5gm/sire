<?php
		
namespace App\Livewire\Forms;
		
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Cursa;
		
class CursaForm extends Form
{		
    public $id;
    public $aescolar_id;
    public $nivel_id;
    public $seccion_id;
    public $salon_id = 1;
    	
    public function guardar()
    {	
    	return Cursa::create($this->all());	
    }	
    public function editar($id){

    	$this->id = $id;

        $item = Cursa::find($id);
        
        $this->aescolar_id = $item->aescolar_id;
	    $this->nivel_id = $item->nivel_id;
	    $this->seccion_id = $item->seccion_id;
    }	
    public function actualizar(){
    	$item = Cursa::find($this->id);
    	$item->update($this->all());
    }	
    public function rules(){
    	
    	return [	
    		'aescolar_id' => 'required|exists:aescolars,id',
    		'seccion_id' => 'required|exists:seccions,id',
    		'nivel_id' => 'required|exists:nivels,id'
    	];	
    }		

    public function validationAttributes(){
    	return [
    		'aescolar_id' => 'Año escolar',
    		'nivel_id' => 'Nivel Academico'
    	];
    }	
}		