<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Aescolar;
use App\Models\Seccion;
use App\Models\Nivel;
use App\Models\Cursa;
use App\Livewire\Forms\CursaForm;

class CursaLive extends Component
{	
	public $open = false;
	public $openEditar = false;
	public $openEliminar = false;

	public $aescolars;
	public $nivels;
	public $seccions;
	public $buscar;
	
	public CursaForm $form;

	public $idBorrar;

	public function mount(){

		$this->aescolars = Aescolar::all();
		$this->nivels = Nivel::all();
		$this->seccions = Seccion::all();
	}	

    public function render()
    {	
    	$items = Cursa::where('aescolar_id','like','%'.$this->buscar.'%')->with('nivel')->with('seccion')->with('aescolar')->paginate(20);

        return view('livewire.cursa-live',compact('items'));
    }
    public function registrar(){

    	$this->form->validate();

        $this->form->guardar();

        $this->form->reset();

        $this->open = false;

        $this->dispatch('success',['mensaje' => 'Operacion exitosa!']);
    }
    public function editar($id){

    	$this->resetValidation();

        $this->openEditar = true;

        $this->form->editar($id);
    }
    public function actualizar(){
    	
    	$this->form->actualizar();

        $this->openEditar = false;
        
        $this->dispatch('success',['mensaje' => 'Operacion exitosa!']);
    }
    public function borrar($id){
    	
    	$this->idBorrar = $id;
        $this->openEliminar = true;
    }
    public function eliminar(){

    	$item = Cursa::find($this->idBorrar);

        $item->delete();  

        $this->reset(['idBorrar','openEliminar']);

        $this->dispatch('success',['mensaje' => 'Operacion exitosa!']);
    }
}
