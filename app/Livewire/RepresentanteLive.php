<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Representante;
use App\Models\Representado;
use App\Models\Estudiante;
use App\Livewire\Forms\RepresentanteForm;
use App\Livewire\Forms\AsignarEstudianteRepresentante;
use Livewire\WithPagination;

class RepresentanteLive extends Component
{
    use WithPagination;

    public $open = false;
    public $openEditar = false;
    public $openEliminar = false;

    #[Url]
    public $buscar = "";
    #[Url]
    public $buscarEstudiante = "";
        
    public RepresentanteForm $registrarForm;
    public RepresentanteForm $editarForm;
    public asignarEstudianteRepresentante $estudianteForm;
            
    public $idBorrar;
    public $idBorrarEst;
    public $estudiante_id;
    public $estudiantes;

    public $idRepresentante;
    public $listaEstudiante = [];

    public $openEstudiante = false;
    public $openEliminarEst = false;

    public function mount(){
        $this->estudiantes = Estudiante::all();
    }   
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $this->estudiantes = Estudiante::select('id','cedula','nombre','paterno')->get();
    	
        $items = Representante::orWhere('nombre','like','%'.$this->buscar.'%')->orWhere('cedula','like','%'.$this->buscar.'%')->with('representados')->paginate(10);
        
        return view('livewire.representante-live',compact('items'));
    }
    public function registrar(){
        
        $this->registrarForm->validate();

        $this->registrarForm->guardar();

        $this->registrarForm->reset();

        $this->open = false;

        $this->dispatch('success');

        $this->resetPage();
    }       
    public function editar($id){
        
        $this->resetValidation();

        $this->openEditar = true;
        
        $this->editarForm->editar($id);
    }       
    public function actualizar(){

        $this->editarForm->actualizar();

        $this->openEditar = false;
        
        $this->dispatch('success');
    }   
    public function borrar($id)
    {       
        $this->idBorrar = $id;
        $this->openEliminar = true;
    }       
    public function eliminar(){
            
        $item = Representante::find($this->idBorrar);

        $item->delete();  

        $this->reset(['idBorrar','openEliminar']);
    }
    public function estudiante($id){     
        
        $this->resetValidation();

        $this->reset(['listaEstudiante']);
        $this->openEstudiante = true;
        $this->idRepresentante = $id;

        $this->listaEstudiante = Estudiante::whereHas('representados',function($query) use ($id){$query->where('representante_id',$id);})
        ->with(['representados'=>function($query) use ($id){
            $query->where('representante_id',$id)->select('estudiante_id','relacion');
        }])->get();
    }	
    public function estudianteAsignar(){
         
        $this->estudianteForm->validate();
        $this->estudianteForm->guardar($this->idRepresentante);  

        $this->dispatch('success');
        $this->estudiante($this->idRepresentante);
    }       
    public function borrarEst($idEst){
        $this->idBorrarEst = $idEst;
        $this->openEliminarEst = true;
    }   
    public function eliminarEst(){
        
        Representado::where('estudiante_id',$this->idBorrarEst)->delete();
        $this->dispatch('success');
        $this->reset(['openEliminarEst']);
        
        $this->estudiante($this->idRepresentante);
    }   	
}
		