<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Representante;
use App\Livewire\Forms\RepresentanteRegistrarForm;
use App\Livewire\Forms\RepresentanteEditarForm;
use Livewire\WithPagination;

class Representante extends Component
{
    public $open = false;
    public $openEditar = false;
    public $openEliminar = false;

    #[Url]
    public $buscar = "";
        
    public RepresentanteRegistrarForm $registrar;
    public RepresentanteEditarForm $editar;
            
    public $idBorrar;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $items = Representante::orWhere('nombre','like','%'.$this->buscar.'%')->orWhere('cedula','like','%'.$this->buscar.'%')->paginate(10);
        
        return view('livewire.representante',compact('items'));
    }
    public function registrar(){
        
        $this->registrar->validate();

        $this->registrar->guardar();

        $this->registrar->reset();

        $this->open = false;

        $this->dispatch('success',['mensaje' => 'Operacion exitosa!']);

        $this->resetPage();
    }       
    public function editar($id){
        
        $this->resetValidation();

        $this->openEditar = true;
        
        $this->editar->editar($id);
    }       
    public function actualizar(){

        $this->editar->actualizar();

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
