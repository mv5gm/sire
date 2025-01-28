<?php

namespace App\Livewire\Empleado;

use Livewire\Component;
use App\Models\Empleado;
use App\Livewire\Forms\EmpleadoRegistrar;
use App\Livewire\Forms\EmpleadoEditar;


class Crud extends Component
{	
	public $open = false;
    public $openEditar = false;
    public $openEliminar = false;
    
    public $idBorrar;

    public $buscar = "";

    public EmpleadoRegistrar $registrarForm;
    public EmpleadoEditar $editarForm;

    public function render()
    {

        $items = Empleado::where('nombre','like','%'.$this->buscar.'%')->paginate(10);

        return view('livewire.empleado.crud',compact('items'));
    }
    public function registrar(){
    	
    	//dd($this->registrarForm);

    	$this->registrarForm->validate();

        $this->registrarForm->guardar();

        $this->registrarForm->reset();

        $this->open = false;

        $this->dispatch('success',['mensaje' => 'Operacion exitosa!']);
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
            
        $item = Empleado::find($this->idBorrar);

        $item->delete();  

        $this->reset(['idBorrar','openEliminar']);

        $this->dispatch('success',['mensaje' => 'Operacion exitosa!']);
    }
}
