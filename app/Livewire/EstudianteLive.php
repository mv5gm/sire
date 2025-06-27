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
use App\Livewire\Forms\CursaForm;
use App\Livewire\Forms\EstudianteForm;
use App\Livewire\Forms\RepresentanteForm;
//use App\Livewire\Forms\EstudianteEditarForm;
use App\Livewire\Forms\asignarRepresentanteEstudiante;
use App\Livewire\Forms\inscripcionForm;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class EstudianteLive extends Component
{	
	use WithPagination;

	public $open = false;
    public $openEditar = false;
    public $openEliminar = false;
    public $openRepresentante = false;
    public $openEliminarRep = false;

    public $mostrarRepresen = false;

    public $idEstudiante;
    public $listaRepresentante = [];

    public $representante_id;
    public $representantes = [];

    #[Url]
    public $buscar = "";
        
    public CursaForm $cursa;
    public EstudianteForm $form;
    public RepresentanteForm $representanteRegistrar;
    //public EstudianteEditarForm $estudianteEditar;
    public asignarRepresentanteEstudiante $representanteForm;
    public inscripcionForm $inscripcion;
            
    public $nivels;
    public $seccions;
    public $aescolars;
    
    public $estados = [];
    public $estado_id;
    public $municipios = [];
    public $municipio_id;
    public $parroquias = [];

    public $idBorrar;
    public $idBorrarRep;
    public $relacion = 'Legal';
        
    public function mount(){    

        $cursas = Cursa::pluck('nivel_id','seccion_id');

        $this->seccions = Seccion::whereIn('id',Cursa::pluck('seccion_id'))->get();

        $this->nivels = Nivel::whereIn('id',Cursa::pluck('nivel_id'))->get();
            
        $this->aescolars = Aescolar::all();
        
        $this->estados = Estado::all();
    }       
    public function updatingBuscar()
    {           
        $this->resetPage();
    }   
    public function updatedEstadoId(){

        $this->municipios = Municipio::where('estado_id',$this->estado_id)->get();
    }   
    public function updatedMunicipioId(){
        
        $this->parroquias = Parroquia::where('municipio_id',$this->municipio_id)->get();    
    }   

    public function render()
    {
        $this->representantes = Representante::select('id','cedula','nombre','paterno')->get();

        $estudiantes = Estudiante::where('estudiantes.nombre', 'like', '%' . $this->buscar . '%')
            ->orWhere('estudiantes.cedula', 'like', '%' . $this->buscar . '%')
            ->join('inscripcions', 'estudiantes.id', '=', 'inscripcions.estudiante_id')
            ->join('cursas', 'inscripcions.cursa_id', '=', 'cursas.id')
            ->join('nivels', 'cursas.nivel_id', '=', 'nivels.id')
            ->orderBy('nivels.id', 'asc')
            ->select('estudiantes.*')
            ->paginate(15);

        return view('livewire.estudiante-live',compact('estudiantes'));
    }
    public function registrar(){

        $this->form->validate();

        $estudiante_id = $this->form->guardar()->id;
        
        $representante_id = $this->representante_id;

        if ($this->mostrarRepresen) {

            $this->representanteRegistrar->validate();
            
            $representante_id = $this->representanteRegistrar->guardar()->id;            
        }   

        $re = new Representado;
        $re->representante_id = $representante_id;
        $re->estudiante_id = $estudiante_id;
        $re->relacion = $this->relacion;
        $re->save();

        //$this->form->reset();
        //$this->representanteRegistrar->reset();

        $this->open = false;

        $this->dispatch('success');
    	//session()->flash('message', 'Operacion exitosa!!.');

        $this->resetPage();
    }       
    public function registrarEstudiante(){
        $error = '';
        try {
            
            //dd($this->form->fecha);

            DB::beginTransaction();
            $this->cursa->validate();

            $estudiante = $this->form->guardar();

            $cursa = Cursa::Buscar($this->cursa->aescolar_id,
                                    $this->cursa->nivel_id,
                                    $this->cursa->seccion_id,
                                    '1')->first();

            $this->inscripcion->estudiante_id = $estudiante->id;
            $this->inscripcion->cursa_id = $cursa->id;
            $this->inscripcion->tipo = 'Nuevo';
            $this->inscripcion->guardar();

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            //dd($th);
            $error = $th;
        }

        $estado = ($error == '') ? 'success' : 'error';
        $mensaje = ($error == '') ? 'Guardado con éxito' : $error->getMessage().'-'.$error->getLine();
        $this->reset(['open','cursa']);
        $this->dispatch($estado,['message'=>$mensaje]);
    }   

    public function editar($estudianteId){
        
        $this->resetValidation();

        $this->openEditar = true;
        
        $this->form->editar($estudianteId);

        $cursa = Estudiante::obtenerCursa($estudianteId);

        $this->cursa->aescolar_id = $cursa->aescolar_id;
        $this->cursa->nivel_id = $cursa->nivel_id;
        $this->cursa->seccion_id = $cursa->seccion_id;
    }       
    public function actualizar(){

        $this->form->validate();
        $this->form->actualizar();

        Estudiante::registrarInscripcion($this->form->id,$this->cursa->aescolar_id,$this->cursa->seccion_id,$this->cursa->nivel_id);

        $this->form->reset();

        $this->openEditar = false;
        
        $this->dispatch('success',['message'=>'Actualizado con exito']);
    }                        
    public function borrar($estudianteId)
    {       
        $this->idBorrar = $estudianteId;
        $this->openEliminar = true;
    }       
    public function eliminar(){
            
        $estudiante = Estudiante::find($this->idBorrar);

        $estudiante->delete();   

        $this->reset(['idBorrar','openEliminar']);
        $this->dispatch('success',['message'=>'Eliminado Con exito']);
    }       
    public function representante($id){     
        
        $this->resetValidation();

        $this->reset(['listaRepresentante']);
        $this->openRepresentante = true;
        $this->idEstudiante = $id;

        $this->listaRepresentante = Representante::whereHas('representados',function($query) use ($id){$query->where('estudiante_id',$id);})
        ->with(['representados'=>function($query) use ($id){
            $query->where('estudiante_id',$id)->select('representante_id','relacion');
        }])->get();
    }       

    public function representanteAsignar(){
            
        $this->representanteForm->validate();
        $this->representanteForm->guardar($this->idEstudiante);  

        $this->dispatch('success');
        $this->representante($this->idEstudiante);
    }       
    public function borrarRep($idRep){
        $this->idBorrarRep = $idRep;
        $this->openEliminarRep = true;
    }   
    public function eliminarRep(){
        
        Representado::where('representante_id',$this->idBorrarRep)->delete();
        $this->dispatch('success',['mensaje' => 'Operacion exitosa!']);
        $this->reset(['openEliminarRep']);
        
        $this->representante($this->idEstudiante);
    }   
    public function mostrarRepre(){

        if ($this->mostrarRepresen) {
            $this->mostrarRepresen = false;
        }
        else{
            $this->mostrarRepresen = true;
        }
    }	
    public function mostrarFormulario()
    {
        $this->dispatch('mostrarFormularioCrearEstudiante');
    }
    public function mostrarFormularioEstudiante(){
        $this->open = true;

    }
}		