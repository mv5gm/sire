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
    public $institucion_procedencia;
    public $lentes;
    public $tratamiento;
    public $vive_con;
    public $parto;

    public $parroquia_id = 1;
    
    public $selectedVive = [];
    public $opcionesVive = ['Padre','Madre','Abuelo','Abuela','Otro Familiar'];
   
    public function guardar(){
        
        $this->vive_con = null;
        foreach ($this->selectedVive as $vive) {
            $this->vive_con .= $vive.' ';
        }
        $this->vive_con = substr($this->vive_con,0,-1);

        //dd($this->vive_con);

        $this->validate();

        return Estudiante::createOrUpdate($this->all());

    }   
    
    public function editar($estudianteId){

    	$this->id = $estudianteId;

        $ins =  Inscripcion::where('estudiante_id',$estudianteId)->with('cursa')->with('estudiante')->first();

        $this->fillFromModel($ins->estudiante, $this->all());
        /*
        $this->cedula = $ins->estudiante->cedula;
        $this->nombre = $ins->estudiante->nombre;
        $this->segundo = $ins->estudiante->segundo;
        $this->paterno = $ins->estudiante->paterno;
        $this->materno = $ins->estudiante->materno;
        $this->sexo = $ins->estudiante->sexo;
        $this->lugar = $ins->estudiante->lugar;
        $this->fecha = $ins->estudiante->fecha;  
        $this->situacion = $ins->estudiante->situacion;  
        $this->residencia = $ins->estudiante->residencia;  
        $this->parroquia_id = $ins->estudiante->parroquia_id;  

        $this->seccion_id = $ins->cursa->seccion_id;
        $this->nivel_id = $ins->cursa->nivel_id;
        $this->aescolar_id = $ins->cursa->aescolar_id;
        $this->cursaId = $ins->cursa->id;

        [$this->vive_con,$this->parto] = explode('-',$ins->estudiante->vive_con);
        */
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
            'cedula' =>"nullable|unique:estudiantes,cedula,".$this->cedula,
            'nombre' =>'required|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚ]+$/|min:3|max:70',
            'segundo' =>'nullable|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚ]+$/|max:70',
            'paterno' =>'required|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚ]+$/|min:3|max:70',
            'materno' =>'nullable|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚ]+$/|max:70',
            'fecha' =>'required|date',
            'lugar' =>'nullable|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚ\s]+$/|min:3|max:100',
            'sexo' =>'required|in:f,m',
            'institucion_procedencia' =>'required|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚ\s]+$/|max:100',
            'lentes' =>'required|in:si,no',
            'tratamiento' =>'nullable|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚ\s]+$/|max:100',
            'vive_con' =>'required|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚüÜ()]+$/|max:100',
            'parto' =>'required|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚ\s]+$/|max:100',
            'parroquia_id' =>'required|exists:parroquias,id',
            
        ];  
    }       
    public function validationAttributes(){
        return [
            'segundo' => 'segundo nombre',
            'paterno' => 'primer apellido',
            'materno' => 'segundo apellido',
            'lugar' => 'lugar de nacimiento',
            'fecha' => 'fecha de nacimiento',
            'institucion_procedencia' => 'institucion de peocedencia',
            'vive_con' => 'vive con:',
        ];
    }	
}		