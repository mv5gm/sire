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
    public $alergias;
    public $tipo;

    public $parroquia_id = 1;
    
    public $selectedVive = [];
    public $opcionesVive = ['Padre','Madre','Abuelo(a)','Otro Familiar'];
   
    public function guardar(){
        
        $this->vive_con = null;
        
        foreach ($this->selectedVive as $vive) {
            $this->vive_con .= $vive.' ';
        }
        
        $this->vive_con = substr($this->vive_con,0,-1);

        $this->validate();

        return Estudiante::createOrUpdate($this->all());
    }   
    
    public function editar($estudianteId){

    	$this->id = $estudianteId;

        $ins =  Inscripcion::where('estudiante_id',$estudianteId)->with('cursa')->with('estudiante')->first();

        $this->fill(Estudiante::find($estudianteId)->toArray());
    }   

    public function actualizar(){

        $estudiante = Estudiante::find($this->id);

        $estudiante->update($this->all());


        //$ins = Inscripcion::where('estudiante_id',$estudiante->id)->where('cursa_id',$this->cursaId)->first();  

        //$cursa = Cursa::where('seccion_id',$this->seccion_id)->where('nivel_id',$this->nivel_id)->where('aescolar_id',$this->aescolar_id)->first();

        //if(  isset($cursa->id) ){

        //    $ins->cursa_id = $cursa->id;
        //}
        
        //$ins->save();

        //$this->reset();    
    }

    public function rules(){   
            
        return [
            'cedula' =>[
                'nullable',
                Rule::unique('estudiantes', 'cedula')->ignore($this->id),
            ],
            'nombre' =>'required|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚüÜ\s]+$/|min:3|max:70',
            'segundo' =>'nullable|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚüÜ\s]+$/|max:70',
            'paterno' =>'required|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚüÜ\s]+$/|min:3|max:70',
            'materno' =>'nullable|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚüÜ\s]+$/|max:70',
            'fecha' =>'required|date',
            'lugar' =>'nullable|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚ\s]+$/|min:3|max:100',
            'sexo' =>'required|in:f,m',
            'institucion_procedencia' =>'nullable|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚ\s]+$/|max:100',
            'lentes' =>'required|in:si,no',
            'tratamiento' =>'nullable|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚ\s]+$/|max:100',
            'vive_con' =>'required|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚüÜ()\s]+$/|max:100',
            'parto' =>'required|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚ\s]+$/|max:100',
            'alergias' =>'required|in:asma,respiratorias,rinitis,ninguna',
            'tipo' =>'required|in:Normal,Especial,Exonerado',
            'parroquia_id' =>'required|exists:parroquias,id',
            
        ];  
    }       
    public function validationAttributes(){
        return [
            'cedula' => 'Cedula de estudiante',
            'nombre' =>'nombre de estudiante',
            'segundo' => 'segundo nombre de estudiante',
            'paterno' => 'primer apellido de estudiante',
            'materno' => 'segundo apellido de estudiante',
            'lugar' => 'lugar de nacimiento de estudiante',
            'fecha' => 'fecha de nacimiento de estudiante',
            'sexo' =>'sexo de estudiante',
            'institucion_procedencia' =>'institucion de procedencia de estudiante',
            'lentes' =>'lentes de estudiante',
            'tratamiento' =>'tratamiento de estudiante',
            'vive_con' =>'estudiante vive con...',
            'parto' =>'Tipo de parto de estudiante',
            'alergias' =>'alergias de estudiante',
            'tipo' =>'tipo de estudiantes',
            'parroquia_id' =>'parroquia de estudiante',
        ];
    }	
}		