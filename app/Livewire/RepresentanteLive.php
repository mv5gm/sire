<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Representante;
use App\Models\Estudiante;
use App\Livewire\Forms\RepresentanteForm;
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
            
    public $idBorrar;

    public $estudiantes;

    public function mount(){
        $this->estudiantes = Estudiante::all();
    }   
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
    	$items = Representante::orWhere('nombre','like','%'.$this->buscar.'%')->orWhere('cedula','like','%'.$this->buscar.'%')->paginate(10);
        
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
}		