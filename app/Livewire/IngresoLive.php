<?php
	
namespace App\Livewire;
	
use Livewire\Component;
use App\Models\Ingreso;
use App\Models\Pago;
use App\Models\PagoMes;
use App\Models\Representante;
use App\Models\Estudiante;
use App\Livewire\Forms\IngresoForm;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
	
class IngresoLive extends Component
{			
    use WithPagination;
    public IngresoForm $form;

    public $open = false;
    public $openEliminar = false;

    #[Url]
    public $buscar = "";
        
    public function abrirModal(){
        $this->id = null;
        $this->open = true;
    }
	public function mount(){
    	
    }				
    public function updatingBuscar()
    {	
        $this->resetPage();
    }	
   		
    public function guardar(){

        $this->form->validate();
        
    	$this->form->guardar();
        $this->dispatch('success', ['message' => 'Guardado con éxito']);

        $this->open = false;	
    }					
    public function editar($id){
        $this->open = true;
    	$this->form->editar($id);
    }	
    public function borrar($id){
    	$this->form->id = $id;
    	$this->openEliminar = true;
    }	
    public function eliminar(){
    	Ingreso::find($this->form->id)->delete();
        $this->dispatch('success', ['message' => 'Eliminado con éxito']);
        $this->form->id = null;
        $this->openEliminar = false;
    }	
    public function render()
    {	
        $items = Ingreso::whereDoesntHave('pagos')
        ->where(function ($query) {
            $query->where('cantidad', 'like', '%' . $this->buscar . '%')
                ->orWhere('fecha', 'like', '%' . $this->buscar . '%')
                ->orWhere('forma', 'like', '%' . $this->buscar . '%');
        })
        ->paginate();

        return view('livewire.ingreso-live',compact('items'));
    }	
}		