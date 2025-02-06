<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empleado;
use App\Livewire\Forms\EmpleadoForm;

class EmpleadoLive extends Component
{	
    public $open = false;
    public $openEditar = false;
    public $openEliminar = false;
    
    public $idBorrar;

    public $buscar = "";

    public EmpleadoForm $registrarForm;
    public EmpleadoForm $editarForm;

    public function render()
    {
        $items = Empleado::where('nombre','like','%'.$this->buscar.'%')->paginate(10);

        return view('livewire.empleado-live',compact('items'));
    }
    public function registrar(){
    	
    	//dd($this->registrarForm);

    	$this->registrarForm->validate();

        $this->registrarForm->guardar();

        $this->registrarForm->reset();

        $this->open = false;

        $this->dispatch('success');
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
            
        $item = Empleado::find($this->idBorrar);

        $item->delete();  

        $this->reset(['idBorrar','openEliminar']);

        $this->dispatch('success');
    }	
}		