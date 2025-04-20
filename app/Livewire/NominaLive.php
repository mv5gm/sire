<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Nomina;
use App\Models\Empleado;
use App\Livewire\Forms\NominaForm;

class NominaLive extends Component
{   
    public $open = false;
    public $openEliminar = false;
    public $openNomina = true;
    
    public $buscar = "";

    public NominaForm $form;

    public $empleados;
    public $dolar = 1;
    public $horas = 1;
    public $matricula = 1;
    public $tipo = 1;
    public $anio;
    public $mes;
    public $quincena = 1;
    public $cantidades = [];

    public function render()
    {   
        $items = Nomina::with('empleado')
            ->whereHas('empleado', function ($query) {
            $query->where('nombre', 'like', '%' . $this->buscar . '%');
            })
            ->orWhere('mes','like','%'.$this->buscar.'%')
            ->orWhere('anio','like','%'.$this->buscar.'%')
            ->paginate(10);

        return view('livewire.nomina-live',compact('items'));
    }
    public function mount()
    {
        $this->empleados = Empleado::all();
        $this->anio = date('Y');
        $this->mes = date('m');
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
        $this->form->id = $id;
        $this->openEliminar = true;
    }
    public function eliminar(){
            
        $item = Nomina::find($this->form->id);

        $item->delete();  

        $this->reset(['openEliminar']);

        $this->dispatch('success',['message' => 'Eliminado con exito']);
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
    public function updatedTipo(){
        $this->calculoCantidad();
    }
    public function calculoCantidad(){

        $cantidadesActualizadas = []; // Crear un nuevo arreglo para almacenar las cantidades actualizadas

        foreach ($this->empleados as $key => $value) {
            // Convertir las variables a números flotantes
            $dolar = floatval($this->dolar);
            $horas = floatval($this->horas);
            $matricula = floatval($this->matricula);
            $tipo = $this->tipo == 'Mensual' ? 1: 2;

            //dd($tipo);

            if ($value->tipo == 'Maestro') {

                $cantidadesActualizadas[$value->id] = round((floatval($value->matricula) * $matricula * $dolar) / $tipo,2);
            } elseif ($value->tipo == 'Docente') {
                
                $cantidadesActualizadas[$value->id] = round(($dolar * $horas * $value->horas * 4) / $tipo,2 );
            } else {
                
                $cantidadesActualizadas[$value->id] = round((floatval($value->sueldo)) / $tipo ,2);
            }
        }
        // Reasignar el arreglo completo para que Livewire detecte los cambios
        $this->cantidades = $cantidadesActualizadas;
    }
    public function guardarNomina(){
        
        $this->form->guardarNomina($this->cantidades,$this->tipo,$this->mes,$this->anio,$this->quincena);
        $this->dispatch('success',['message' => 'Nomina guardada con exito']);
        $this->openNomina = false;
    }   
}       