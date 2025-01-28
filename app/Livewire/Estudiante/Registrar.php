<?php

namespace App\Livewire\Estudiante;

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
use App\Livewire\Forms\EstudianteRegistrarForm;
use App\Livewire\Forms\RepresentanteRegistrarForm;
use App\Livewire\Forms\EstudianteEditarForm;
use App\Livewire\Forms\asignarRepresentanteEstudiante;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
        
class Registrar extends Component
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
        
    public EstudianteRegistrarForm $estudianteRegistrar;
    public RepresentanteRegistrarForm $representanteRegistrar;
    public EstudianteEditarForm $estudianteEditar;
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

        $estudiantes = Estudiante::orWhere('nombre','like','%'.$this->buscar.'%')->orWhere('cedula','like','%'.$this->buscar.'%')->paginate(10);
        
        return view('livewire.estudiante.registrar',compact('estudiantes'));
    }       

    public function registrar(){
        
        $this->estudianteRegistrar->validate();

        $estudiante_id = $this->estudianteRegistrar->guardar()->id;
        
        $representante_id = $this->representante_id;

        if ($this->mostrarRepresen) {

            $this->representanteRegistrar->validate();
            
            $representante_id = $this->representanteRegistrar->guardar()->id;            
        }   

        $re = new Representado;
        $re->representante_id = $representante_id;
        $re->estudiante_id = $estudiante_id;
        $re->save();

        $this->estudianteRegistrar->reset();
        //$this->representanteRegistrar->reset();

        $this->open = false;

        $this->dispatch('success',['mensaje' => 'Estudiante Registrado!']);

        $this->resetPage();
    }       
    public function editar($estudianteId){
        
        $this->resetValidation();

        $this->openEditar = true;
        
        $this->estudianteEditar->editar($estudianteId);
    }       
    public function actualizar(){

        $this->estudianteEditar->validate();
        $this->estudianteEditar->actualizar();

        $this->openEditar = false;
        
        $this->dispatch('success',['mensaje' => 'Estudiante Registrado!']);
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