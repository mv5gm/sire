<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empleado;
use App\Livewire\Forms\EmpleadoForm;

class EmpleadoLive extends Component
{	
    public $open = false;
    public $openEliminar = false;
    public $openNomina = true;
    
    public $idBorrar;

    public $buscar = "";

    public EmpleadoForm $form;

    public $empleados;
    
    public function mount(){
        $this->empleados = Empleado::all();
    }
    public function render()
    {
        $items = Empleado::where('nombre','like','%'.$this->buscar.'%')->paginate(10);

        return view('livewire.empleado-live',compact('items'));
    }
    public function registrar(){
        $this->form->reset();
        $this->open = true;
    }
    public function guardar(){

    	$this->form->validate();

        $this->form->guardar();

        $this->form->reset();

        $this->open = false;
        
        $this->dispatch('success', ['message' => 'Guardado con exito']);
    }
    public function editar($id){
        
        $this->resetValidation();

        $this->open = true;

        $this->form->editar($id);

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