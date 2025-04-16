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

    public $textConversion;

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
    public function updatedFormDolar(){
        $this->calcularConversion();
    }
    public function updatedFormCantidad(){
        $this->calcularConversion();
    }
    public function updatedFormForma(){
        $this->calcularConversion();
    }
    public function calcularConversion(){
        $cantidad = (float) ($this->form->cantidad ?? 0);
        $dolar = (float) ($this->form->dolar ?? 1); // Valor predeterminado de 1 si no se establece
        
        if ($dolar > 0) {
            if ($this->form->forma == 'divisa') {
                $conversion = $cantidad * $dolar;
                $unidad = 'Bs';
            } else {
                $conversion = $cantidad / $dolar;
                $unidad = '$';
            }
            $this->textConversion = 'Conversion: ' . number_format($conversion, 2) . ' ' . $unidad;
        } else {
            $this->textConversion = 'Error: El valor del dólar no puede ser 0.';
        }
    }
}
