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
    public $mostrarFormulario = true;

    protected $listeners = ['mostrarFormularioCrearEstudiante' => 'mostrarFormulario'];

    public EstudianteForm $estudianteForm;
    public RepresentanteForm $representanteForm;
    public RepresentanteForm $representanteFormAutorizado;
    public RepresentanteForm $representanteFormAutorizado2;
    public RepresentadoForm $representadoForm;
    public RepresentadoForm $representadoFormAutorizado;
    public RepresentadoForm $representadoFormAutorizado2;
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

    public $mostrarSegundoAutorizado = false;

    public $representanteRegistrado = false;
    public $autorizadoRegistrado = false;
    public $autorizado2Registrado = false;

    public $representante_id;
    public $autorizado_id;
    public $autorizado2_id;

    public $representantes = [];

    public function mount(){    

        $this->seccions = Seccion::whereIn('id',Cursa::pluck('seccion_id'))->get();

        $this->nivels = Nivel::whereIn('id',Cursa::pluck('nivel_id'))->get();
        	    
        $this->aescolars = Aescolar::all();
        	
        $this->estados = Estado::all();

        $this->representantes = Representante::all();

        $this->estudianteForm->parto = 'natural';
        $this->estudianteForm->sexo = 'f';
        $this->estudianteForm->lentes = 'no';
        $this->representanteForm->estado_civil = 'Soltero(a)';
        $this->representanteForm->condicion_laboral = 'Empleado(a)';
        $this->representadoForm->relacion = 'Legal';
        $this->representadoFormAutorizado->relacion = 'Autorizado';
        $this->representadoForm->parentesco = 'Madre';
        $this->hogarForm->representante_economico = 'Padre';
        $this->hogarForm->gastos_separados = 'no';
        $this->cursaForm->aescolar_id = 1;
        $this->cursaForm->nivel_id = 1;
        $this->cursaForm->seccion_id = 1;
    }		

    public function updatedEstadoId(){
    		
        $this->municipios = Municipio::where('estado_id',$this->estado_id)->get();
    }   
    public function updatedMunicipioId(){
        	
        $this->parroquias = Parroquia::where('municipio_id',$this->municipio_id)->get();    
    }	
    public function updatedRepresentadoFormParentesco(){
        	
        $this->logicaRepresentante();    
    }           
    public function updatedRepresentadoFormAutorizadoParentesco(){

    }       
    public function updatedRepresentadoFormAutorizado2Parentesco(){
        
    }       

    public function registrar(){
        
        $error = '';

        try {   

            DB::beginTransaction();

            $estudiante = $this->estudianteForm->guardar();

            $representante = $this->representanteForm->guardar();
            $representante2 = $this->representanteFormAutorizado->guardar();
            
            if($this->mostrarSegundoAutorizado){
                $representante3 = $this->representanteFormAutorizado2->guardar();
            }

            $hogar = $this->hogarForm->guardar();

            $this->representadoForm->estudiante_id = $estudiante->id;
            $this->representadoForm->representante_id = $representante->id;
            $this->representadoForm->hogar_id = $hogar->id;
            $this->representadoForm->relacion = 'Legal';
            $this->representadoForm->guardar();

            $this->representadoFormAutorizado->estudiante_id = $estudiante->id;
            $this->representadoFormAutorizado->representante_id = $representante2->id;
            $this->representadoFormAutorizado->hogar_id = $hogar->id;
            $this->representadoForm->relacion = 'Autorizado';
            $this->representadoFormAutorizado->guardar();
            
            if($this->mostrarSegundoAutorizado){
                $this->representadoFormAutorizado2->estudiante_id = $estudiante->id;
                $this->representadoFormAutorizado2->representante_id = $representante3->id;
                $this->representadoFormAutorizado2->hogar_id = $hogar->id;
                $this->representadoFormAutorizado2->relacion = 'Autorizado';
                $this->representadoFormAutorizado2->guardar();
            }

            $cursa = Cursa::Buscar($this->cursaForm->aescolar_id,
                                    $this->cursaForm->nivel_id,
                                    $this->cursaForm->seccion_id,
                                    $this->cursaForm->salon_id)->first();

            $this->inscripcionForm->estudiante_id = $estudiante->id;
            $this->inscripcionForm->cursa_id = $cursa->id;
            $this->inscripcionForm->tipo = 'Nuevo';
            $this->inscripcionForm->guardar();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $error = $th;
        }   

        $estado = ($error == '') ? 'success' : 'error';
        $mensaje = ($error == '') ? 'Guardado con éxito' : $error->getMessage().'-'.$error->getLine();
        $this->dispatch($estado, ['message' => $mensaje]);

    }   
    public function mostrarFormulario()
    {	
        $this->mostrarFormulario = true;

        $this->dispatch('fillFormRegistrarEstudiante');
    }   

    public function cerrarFormulario()
    {   	
        $this->mostrarFormulario = false;
    }   	
    public function logicaRepresentante(){ 
        //si el primer representante tiene que ser el tutor legal obligatoriamente
        if($this->representadoForm->parentesco != 'Padre' && $this->representadoForm->parentesco != 'Madre'){
            $this->mostrarSegundoAutorizado = true;
        }else{
            $this->mostrarSegundoAutorizado = false;
        }	
    }		
    public function mostrarRepresentanteRegistrado($var){
    	$this->representanteRegistrado = $var;
    }
    public function mostrarAutorizadoRegistrado($var){
    	$this->autorizadoRegistrado = $var;
    }
    public function mostrarAutorizado2Registrado($var){
    	$this->autorizado2Registrado = $var;
    }   	
    public function render()
    {	
        return view('livewire.estudiante-crear-live');
    }	
}		