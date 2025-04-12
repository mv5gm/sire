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
	
	public $buscar;
	public $idBorrar;

    public $cantidadB;

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
       
        $this->open = true;
        $this->form->reset();
    }   
    public function guardar(){

    	$this->form->validate();

        $this->form->guardar();

        $this->form->reset();

        $this->open = false;

        $this->dispatch('success');
    }
    public function editar($id){

    	$this->resetValidation();

        $this->open = true;

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

    public function updatedCantidadB(){
        $cantidadB = floatval(str_replace(',', '.', $this->cantidadB)); // Manejar comas como separadores decimales
        $dolar = floatval(str_replace(',', '.', $this->form->dolar)); // Manejar comas como separadores decimales

        //dd($this->cantidadB,$dolar);

        if ($dolar > 0) {
            $this->form->cantidad = round($cantidadB / $dolar, 2); // Realizar la división y redondear a 2 decimales

        } else {
            $this->form->cantidad = 0; // Valor predeterminado si el divisor es 0
        }
    }

    public function updatedFormCantidad (){
        $cantidad = floatval($this->form->cantidad); // Convertir a número flotante
        $dolar = floatval($this->form->dolar); // Convertir a número flotante
    
        if ($dolar > 0) {
            $this->cantidadB = round($cantidad * $dolar, 2); // Realizar la multiplicación
        } else {
            $this->cantidadB = 0; // Valor predeterminado si el divisor es 0
        }
    }
}
