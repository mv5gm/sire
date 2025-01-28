<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Gasto;
use App\Livewire\Forms\GastoForm;

class Gastoslive extends Component
{
    public $open = false;
	public $openEditar = false;
	public $openEliminar = false;
	public $openPrecio = false;
	
	public $buscar;
	public $idBorrar;

	public GastoForm $form;

	public function mount(){
		//$this->items = Gasto::paginate();
	}	

    public function render()
    {
    	$items = Gasto::where('descripcion','like','%'.$this->buscar.'%')->paginate();

        return view('livewire.gastoslive',compact('items'));
    }

    public function registrar(){

    	$this->form->validate();

        $this->form->guardar();

        $this->form->reset();

        $this->open = false;

        $this->dispatch('success');
    }
    public function editar($id){

    	$this->resetValidation();

        $this->openEditar = true;

        $this->form->editar($id);
    }
    public function actualizar(){
    	
    	$this->form->actualizar();

        $this->openEditar = false;
        
        $this->dispatch('success');
    }
    public function borrar($id){
    	
    	$this->idBorrar = $id;
        $this->openEliminar = true;
    }
    public function eliminar(){

    	$item = Gasto::find($this->idBorrar);

        $item->delete();  

        $this->reset(['idBorrar','openEliminar']);

        $this->dispatch('success');
    }
    public function updatingFormTipo(){

    	//dd($this->form->tipo);
    }
}
