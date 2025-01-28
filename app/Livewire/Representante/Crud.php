<?php

namespace App\Livewire\Representante;

use Livewire\Component;
use App\Models\Representante;
use App\Models\Estudiante;
use App\Livewire\Forms\RepresentanteRegistrarForm;
use App\Livewire\Forms\RepresentanteEditarForm;
use Livewire\WithPagination;

class Crud extends Component
{
    use WithPagination;

    public $open = false;
    public $openEditar = false;
    public $openEliminar = false;

    #[Url]
    public $buscar = "";
    #[Url]
    public $buscarEstudiante = "";
        
    public RepresentanteRegistrarForm $registrarForm;
    public RepresentanteEditarForm $editarForm;
            
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
        
        return view('livewire.representante.crud',compact('items'));
    }
    public function registrar(){
        
        $this->registrarForm->validate();

        $this->registrarForm->guardar();

        $this->registrarForm->reset();

        $this->open = false;

        $this->dispatch('success',['mensaje' => 'Operacion exitosa!']);

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
        
        $this->dispatch('success',['mensaje' => 'Operacion exitosa!']);
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
