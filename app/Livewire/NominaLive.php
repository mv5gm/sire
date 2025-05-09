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
    public $openNomina = false;
    
    public $buscar = "";

    public NominaForm $form;

    public $empleados;
    public $dolar = 1;
    public $horas = 1;
    public $normal = 1;
    public $especial = 1;
    public $tipo = 'Mensual';
    public $anio;
    public $mes;
    public $quincena = 'Primera';
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
        $this->mes = Intval(date('m'));
    }
    public function registrar(){
        $this->form->reset();
        $this->open = true;
    }
    public function guardar(){

    	$this->form->validate();

        //$this->nominaExiste();

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
    public function updatedNormal(){
        $this->calculoCantidad();
    }
    public function updatedEspecial(){
        $this->calculoCantidad();
    }
    public function calculoCantidad(){

        $cantidadesActualizadas = []; // Crear un nuevo arreglo para almacenar las cantidades actualizadas

        foreach ($this->empleados as $key => $value) {
            // Convertir las variables a números flotantes
            $dolar = floatval($this->dolar);
            $horas = floatval($this->horas);
            $normal = floatval($this->normal);
            $especial = floatval($this->especial);

            $tipo = $this->tipo == 'Mensual' ? 1 : 2;
                
            if ($value->tipo == 'Maestro') {
                $empleado = Empleado::find($value->id);

                $cantidadesActualizadas[$value->id] = round(floatval($empleado->calcularSueldoMaestro($normal,$especial) * $dolar ) / $tipo,2);
            } elseif ($value->tipo == 'Docente') {
                
                $cantidadesActualizadas[$value->id] = round(($dolar * $horas * $value->horas * 4) / $tipo,2 );
            } else {
                
                $cantidadesActualizadas[$value->id] = round((floatval($value->sueldo) * $dolar ) / $tipo ,2);
            }
        }
        // Reasignar el arreglo completo para que Livewire detecte los cambios
        $this->cantidades = $cantidadesActualizadas;
    }
    public function guardarNomina(){
        
        foreach ($this->cantidades as $empleadoId => $cantidad) {
            // Verificar si ya existe un registro mensual para el mismo empleado, año y mes
            $existeNominaMensual = Nomina::where('empleado_id', $empleadoId)
            ->where('anio', $this->anio)
            ->where('mes', $this->mes)
            ->where('tipo', 'Mensual')
            ->exists();

            if ($existeNominaMensual) {
            $this->dispatch('error', ['message' => "El empleado ID $empleadoId ya tiene un pago mensual registrado para este mes. No se pueden ingresar nóminas quincenales."]);
            return; // Detener el proceso si se encuentra un conflicto
            }

            // Verificar si ya existe un registro quincenal para el mismo empleado, año y mes
            $existeNomina = Nomina::where('empleado_id', $empleadoId)
            ->where('anio', $this->anio)
            ->where('mes', $this->mes)
            ->when($this->tipo == 'Quincenal', function ($query) {
                $query->where('quincena', $this->quincena);
            })
            ->exists();

            if ($existeNomina) {
            if ($this->tipo == 'Quincenal' && $this->quincena == 'Primera') {
                $this->dispatch('error', ['message' => "El empleado ID $empleadoId ya tiene un pago registrado para la primera quincena de este mes."]);
            } else {
                $this->dispatch('error', ['message' => "El empleado ID $empleadoId ya tiene un pago registrado para este mes."]);
            }
            return; // Detener el proceso si se encuentra un conflicto
            }
        }

        $this->form->guardarNomina($this->cantidades,$this->tipo,$this->mes,$this->anio,$this->quincena);
        $this->dispatch('success',['message' => 'Nomina guardada con exito']);
        $this->openNomina = false;
        return redirect()->route('descargar.nomina');
    }
    
    public function nominaExiste($empleado_id,$anio,$mes,$quincena){
        
    }
}       