<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Representante;
use App\Models\Estudiante;
use App\Models\Representado;

class AsignarEstudianteRepresentante extends Form
{
    public $idEst;
    public $estudiante_id;
    public $relacion = 'Legal';
    
    public function guardar($idRepresentante){

    	$id = Estudiante::find($this->idEst)->id;

        $cont = Representado::where('representante_id',$idRepresentante)->where('relacion','Legal')->count();

        if ( $cont > 0 ) {
            $this->relacion = 'Autorizado';
        }

		Representado::create([   
        	'representante_id' => $idRepresentante, 
            'estudiante_id' => $id,
        	'relacion' => $this->relacion 
    	]);
    }

    public function rules(){
        return [
            'idEst' =>'required|exists:estudiantes,id',
            'relacion' =>'required|in:Legal,Autorizado',
        ];  
    }
}
