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
use App\Livewire\Forms\EstudianteForm;
use App\Livewire\Forms\RepresentanteForm;
//use App\Livewire\Forms\EstudianteEditarForm;
use App\Livewire\Forms\asignarRepresentanteEstudiante;
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
        
    public EstudianteForm $form;
    public RepresentanteForm $representanteRegistrar;
    //public EstudianteEditarForm $estudianteEditar;
    public asignarRepresentanteEstudiante $representanteForm;
            
    public $nivels;
    public $seccions;
    public $aescolars;

    public $idBorrar;
    public $idBorrarRep;

    public function mount(){

        $cursas = Cursa::pluck('nivel_id','seccion_id');

        $this->seccions = Seccion::whereIn('id',Cursa::pluck('seccion_id'))->get();

        $this->nivels = Nivel::whereIn('id',Cursa::pluck('nivel_id'))->get();
        
        $this->aescolars = Aescolar::all();
    }
    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->representantes = Representante::select('id','cedula','nombre','paterno')->get();

      $estudiantes = Estudiante::
        where('estudiantes.nombre','like','%'.$this->buscar.'%')
        ->orWhere('estudiantes.cedula','like','%'.$this->buscar.'%')
        ->join('inscripcions', 'estudiantes.id', '=', 'inscripcions.estudiante_id')
        ->join('cursas', 'inscripcions.cursa_id', '=', 'cursas.id')
        ->join('nivels', 'cursas.nivel_id', '=', 'nivels.id')
        ->join('seccions', 'cursas.seccion_id', '=', 'seccions.id')
        ->select('estudiantes.*')
        ->orderBy('nivels.id')
        ->paginate();

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
        $re->save();

        $this->form->reset();
        //$this->representanteRegistrar->reset();

        $this->open = false;

        $this->dispatch('success');

        $this->resetPage();
    }       
    public function editar($estudianteId){
        
        $this->resetValidation();

        $this->openEditar = true;
        
        $this->form->editar($estudianteId);
    }       
    public function actualizar(){

        $this->form->validate();
        $this->form->actualizar();

        $this->openEditar = false;
        
        $this->dispatch('success');
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
    }       
    public function representante($id){     
        
        $this->resetValidation();

        $this->reset(['listaRepresentante']);
        $this->openRepresentante = true;
        $this->idEstudiante = $id;

        $this->listaRepresentante = DB::select('SELECT * FROM representantes WHERE id IN ( select representante_id from representados where estudiante_id = ? )',[$id]);

    }       
    public function representanteAsignar(){
            
        $this->representanteForm->validate();
        $this->representanteForm->guardar($this->idEstudiante);  

        $this->dispatch('success',['mensaje' => 'Operacion exitosa!']);
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
}		