<?php 	
		
namespace App\Livewire\Forms;
		
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;
use App\Models\Nivel;
use App\Models\Seccion;
use App\Models\Aescolar;
use App\Models\Cursa;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use RepresentanteRegistrarForm;
		
class EstudianteForm extends Form
{		
    public $id;
    public $cedula;
    public $nombre;
    public $segundo;
    public $paterno;
    public $materno;
    public $fecha;
    public $lugar;
    public $sexo = 'f';
    public $nivel_id = 1;
    public $seccion_id = 1;
    public $aescolar_id = 1;
    
    public $salon_id = 1;
    public $cursaId;

    public $repre = true;

    public function guardar(){
        
        //$this->cursa_id = Cursa::crear($this->nivel_id,$this->salon_id,$this->aescolar_id,$this->seccion_id);

        $estudiante = Estudiante::create($this->all());
        
        //$estudiante = new Estudiante;

        $cursa = Cursa::where('aescolar_id',$this->aescolar_id)->where('seccion_id',$this->seccion_id)->where('nivel_id',$this->nivel_id)->first();

        //dd($cursa);

        $ins = new Inscripcion;

        $ins->cursa_id = $cursa->id; 
        $ins->estudiante_id = $estudiante->id; 
        $ins->tipo = 'Nuevo'; 
        $ins->save();

        return $estudiante;
    }   
    
    public function editar($estudianteId){

    	$this->id = $estudianteId;

        $ins =  Inscripcion::where('estudiante_id',$estudianteId)->with('cursa')->with('estudiante')->first();

        //$cursa = Cursa::find($estudiante->cursa_id);

        $this->cedula = $ins->estudiante->cedula;
        $this->nombre = $ins->estudiante->nombre;
        $this->segundo = $ins->estudiante->segundo;
        $this->paterno = $ins->estudiante->paterno;
        $this->materno = $ins->estudiante->materno;
        $this->sexo = $ins->estudiante->sexo;
        $this->lugar = $ins->estudiante->lugar;
        $this->fecha = $ins->estudiante->fecha;  

        $this->seccion_id = $ins->cursa->seccion_id;
        $this->nivel_id = $ins->cursa->nivel_id;
        $this->aescolar_id = $ins->cursa->aescolar_id;
        $this->cursaId = $ins->cursa->id;
    }   

    public function actualizar(){

		$estudiante = Estudiante::find($this->id);

        $estudiante->update($this->all());

        $ins = Inscripcion::where('estudiante_id',$estudiante->id)->where('cursa_id',$this->cursaId)->first();  

        $cursa = Cursa::where('seccion_id',$this->seccion_id)->where('nivel_id',$this->nivel_id)->where('aescolar_id',$this->aescolar_id)->first();

        if(  isset($cursa->id) ){

            $ins->cursa_id = $cursa->id;
        }

        
        $ins->save();

        $this->reset();    
    }

    public function rules(){   
        
        return [
            'cedula' =>'unique:estudiantes,cedula',
            'nombre' =>'required|min:3|max:255',
            'segundo' =>'required|min:3|max:255',
            'paterno' =>'required|min:3|max:255',
            'materno' =>'required|min:3|max:255',
            'fecha' =>'required|date',
            'lugar' =>'required|min:3|max:255',
            'sexo' =>'required',
            'nivel_id' =>'required',
            'seccion_id' =>'required',
            'aescolar_id' =>'required'
        ];  
    }
    public function validationAttributes(){
        return [
            'segundo' => 'segundo nombre',
            'paterno' => 'primer apellido',
            'materno' => 'segundo apellido',
            'lugar' => 'lugar de nacimiento',
            'fecha' => 'fecha de nacimiento',
            'nivel_id' => 'nivel academico',
            'seccion_id' => 'seccion'
        ];
    }	
}		