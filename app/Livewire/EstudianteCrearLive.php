<?php 	
		
namespace App\Livewire;
		
use Livewire\Component;
use App\Models\User;
use App\Models\Nivel;
use App\Models\Aescolar;
use App\Models\Seccion;
use App\Models\Salon;
use App\Models\Estudiante;
use App\Models\Representante;
use App\Models\Representado;
use App\Models\Cursa;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Livewire\Forms\EstudianteForm;
use App\Livewire\Forms\RepresentanteForm;
use App\Livewire\Forms\RepresentadoForm;
use App\Livewire\Forms\CursaForm;
use App\Livewire\Forms\InscripcionForm;
use App\Livewire\Forms\HogarForm;
use App\Livewire\Forms\asignarRepresentanteEstudiante;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
		
class EstudianteCrearLive extends Component
{		
    public EstudianteForm $estudianteForm;
    public RepresentanteForm $representanteForm;
    public RepresentadoForm $representadoForm;
    public CursaForm $cursaForm;
    public InscripcionForm $inscripcionForm;
    public HogarForm $hogarForm;
    public asignarRepresentanteEstudiante $asignarRepresentanteEstudiante;
    
    public $nivels;
    public $seccions;
    public $aescolars;
    
    public $estados = [];
    public $estado_id;
    public $municipios = [];
    public $municipio_id;
    public $parroquias = [];
    
    public $relacion = 'Legal';

    public function mount(){    

        $this->seccions = Seccion::whereIn('id',Cursa::pluck('seccion_id'))->get();

        $this->nivels = Nivel::whereIn('id',Cursa::pluck('nivel_id'))->get();
        	    
        $this->aescolars = Aescolar::all();
        	
        $this->estados = Estado::all();
    }	

    public function updatedEstadoId(){

        $this->municipios = Municipio::where('estado_id',$this->estado_id)->get();
    }   
    public function updatedMunicipioId(){
        
        $this->parroquias = Parroquia::where('municipio_id',$this->municipio_id)->get();    
    }	
    public function registrar(){
        
        $error = '';
        try {
            $estudiante = $this->estudianteForm->guardar();

            $representante = $this->representanteForm->guardar();
            
            $hogar = $hogarForm->guardar();

            $this->representadoForm->estudiante_id = $estudiente->id;
            $this->representadoForm->representante_id = $representante->id;
            $this->representadoForm->hogar_id = $hogar->id;
            $this->representadoForm->guardar();
            
            $cursa = Cursa::Buscar($this->estudianteForm->aescolar_id,
                                    $this->estudianteForm->nivel_id,
                                    $this->estudianteForm->seccion_id,
                                    $this->estudianteForm->salon_id,)->first();

            $this->inscripcionForm->estudinte_id = $estudiante->id;
            $this->inscripcionForm->cursa_id = $cursa->id;
            $this->inscripcionForm->tipo = 'Nuevo';
            $this->inscripcionForm->guardar();

        } catch (\Throwable $th) {
            $error = $th;
        }
        
        
        dd($error);
    }
    public function render()
    {	
        return view('livewire.estudiante-crear-live');
    }	
}		