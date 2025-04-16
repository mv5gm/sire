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
    public $openNomina = true;
    
    public $idBorrar;

    public $buscar = "";

    public EmpleadoForm $form;

    public $empleados;
    public $dolar = 1;
    public $horas = 1;
    public $matricula = 1;
    public $frecuenciaNomina = 1;
    public $cantidades = [];

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
    
    public function mostrarNomina(){
        $this->openNomina = true;
    }
    
    public function updatedDolar(){
        $this->calculoCantidad();
    }
    public function updatedHoras(){
        $this->calculoCantidad();
    }
    public function updatedMatricula(){
        $this->calculoCantidad();
    }
    public function updatedFrecuenciaNomina(){
        $this->calculoCantidad();
    }

    public function calculoCantidad(){

        $cantidadesActualizadas = []; // Crear un nuevo arreglo para almacenar las cantidades actualizadas

        foreach ($this->empleados as $key => $value) {
            // Convertir las variables a números flotantes
            $dolar = floatval($this->dolar);
            $horas = floatval($this->horas);
            $matricula = floatval($this->matricula);
            $frecuenciaNomina = floatval($this->frecuenciaNomina);

            if ($value->tipo == 'Maestro') {

                $cantidadesActualizadas[$value->id] = (floatval($value->matricula) * $matricula * $dolar) / $frecuenciaNomina;
            } elseif ($value->tipo == 'Docente') {
                
                $cantidadesActualizadas[$value->id] = ($dolar * $horas * $value->horas * 4) / $frecuenciaNomina ;
            } else {
                
                $cantidadesActualizadas[$value->id] = (floatval($value->sueldo)) / $frecuenciaNomina;
            }
        }
        // Reasignar el arreglo completo para que Livewire detecte los cambios
        $this->cantidades = $cantidadesActualizadas;
    }
}		