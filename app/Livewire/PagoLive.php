<?php
	
namespace App\Livewire;
	
use Livewire\Component;
use App\Models\Representante;
use App\Models\Representado;
use App\Models\Estudiante;
use App\Models\Pago;
use App\Models\Aescolar;
use App\Models\Ingreso;
use App\Livewire\Forms\IngresoForm;
use App\Livewire\Forms\PagoForm;
use App\Livewire\Forms\PagoMesForm;
use App\Livewire\Forms\imprimirPago;
use Livewire\WithPagination;
		
class PagoLive extends Component
{		
    use WithPagination;

    public $open = false;
    public $openEliminar = false;
    
    public $representantes;
    public $estudiantes;
    public $estudiantesSeleccionados = [];
    public $mesesSeleccionados = [];

    public $idBorrar;

    public $buscar = "";

    public PagoForm $form;
    public IngresoForm $ingreso;
    public PagoMesForm $pagoMes;
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function mount(){
        $this->representantes = Representante::all();
        $this->estudiantes = collect();
    }
		
    public function render()
    {		
        $items = Pago::with('ingreso')
            ->selectRaw('ingreso_id, MAX(id) as id') // Adjust fields as needed
            ->selectRaw('count(ingreso_id) as estudiantes') 
            ->groupBy('ingreso_id')
            ->paginate();

        return view('livewire.pago-live',compact('items'));
    }		
    public function guardar(){   
            $this->ingreso->fecha = $this->ingreso->fecha ?? now()->format('Y-m-d');

        $this->ingreso->validate();

        $ingreso = $this->ingreso->guardar();

        $this->form->ingreso_id = $ingreso->id;
            
        foreach ($this->estudiantesSeleccionados as $estudiante) {
            
            $this->form->estudiante_id = $estudiante;
            
            //dd($this->form);

            $this->form->validate();

            $pago = $this->form->guardar();

            if($this->form->tipo == 'Mensualidad'){
                
                foreach($this->mesesSeleccionados as $mess){ 

                    $this->pagoMes->mes = explode('-',$mess)[0];
                    $this->pagoMes->anio = explode('-',$mess)[1];
                    $this->pagoMes->pago_id = $pago->id;

                    $this->pagoMes->validate();

                    $pagoMes = $this->pagoMes->guardar();
                }                    
            }           
        }           

        $this->open = false;

        $this->dispatch('success');
    }               
    public function editar($id){
        
        $this->resetValidation();

        $this->open = true;

        $this->ingreso->editar($id);
        
    }   
    public function borrar($id)
    {       
        $this->idBorrar = $id;
        $this->openEliminar = true;
    }       
    public function eliminar(){
            
        $item = Ingreso::find($this->idBorrar);

        $item->delete();  

        $this->reset(['idBorrar','openEliminar']);

        $this->dispatch('success',['mensaje' => 'Operacion exitosa!']);
    }
    public function updatedFormRepresentanteId(){
        $representante = Representante::with('representados.estudiante')
        ->where('id', $this->form->representante_id)
        ->first();

        // Si el representante existe, asignar los estudiantes a la propiedad $estudiantes
        if ($representante) {
            $this->estudiantes = $representante->representados->map(function ($representado) {
                return $representado->estudiante;
            });
        } else {
            $this->estudiantes = collect(); // Si no hay representante, asignar una colección vacía
        }
    }	
}					