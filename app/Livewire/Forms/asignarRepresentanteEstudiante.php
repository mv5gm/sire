<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Representante;
use App\Models\Representado;

class asignarRepresentanteEstudiante extends Form
{
    public $cedulaRep;
    public $idRep;
    public $estudiante_id;

    public function guardar($idEstudiante){

    	$id = Representante::find($this->idRep)->id;

    	$cont = Representado::where('estudiante_id',$idEstudiante)->where('representante_id',$id)->first();

    	if( $cont == null ){
    		
    		Representado::create([   
            	'estudiante_id' => $idEstudiante, 
            	'representante_id' => $id 
        	]);
    	}
    }

    public function rules(){
        return [
            'idRep' =>'exists:representantes,id',
			
        ];  
    }
    public function validationAttributes(){
        return [
            'cedulaRep' => 'cedula del representante'
        ];
    }
}
