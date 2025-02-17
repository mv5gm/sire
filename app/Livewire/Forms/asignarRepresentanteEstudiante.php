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
    public $relacion = 'Legal';

    public function guardar($idEstudiante){

    	$id = Representante::find($this->idRep)->id;

        $cont = Representado::where('estudiante_id',$idEstudiante)->where('relacion','Legal')->count();

        if ( $cont > 0 ) {
            $this->relacion = 'Autorizado';
        }

		Representado::create([   
        	'estudiante_id' => $idEstudiante, 
            'representante_id' => $id,
        	'relacion' => $this->relacion 
    	]);
    }

    public function rules(){
        return [
            'idRep' =>'required|exists:representantes,id',
            'relacion' =>'required|in:Legal,Autorizado',
        ];  
    }
}
