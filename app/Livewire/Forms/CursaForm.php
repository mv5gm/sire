<?php
		
namespace App\Livewire\Forms;
		
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Cursa;
		
class CursaForm extends Form
{		
    public $id;
    public $aescolar_id = 1;
    public $nivel_id = 1;
    public $seccion_id = 1;
    public $salon_id = 1;
    	
    public function guardar()
    {	
    	$this->validate();

        return Cursa::createOrUpdate($this->all());	            
    }	
    public function editar($id){

    	$this->id = $id;

        $item = Cursa::find($id);
        
        $this->aescolar_id = $item->aescolar_id;
	    $this->nivel_id = $item->nivel_id;
	    $this->seccion_id = $item->seccion_id;
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