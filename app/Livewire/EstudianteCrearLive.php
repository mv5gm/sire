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
use App\Livewire\Forms\asignarRepresentanteEstudiante;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
		
class EstudianteCrearLive extends Component
{		
    public $selectedVive = [];
    public $opcionesVive = ['Padre','Madre','Abuelo(a)','Otro Familiar'];
    public EstudianteForm $form;
    public RepresentanteForm $representanteRegistrar;
    public asignarRepresentanteEstudiante $representanteForm;
    
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

        $cursas = Cursa::pluck('nivel_id','seccion_id');

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

        
    }
    public function render()
    {	
        return view('livewire.estudiante-crear-live');
    }	
}		