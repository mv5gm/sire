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
use Illuminate\Support\Facades\DB;
	
class IngresoLive extends Component
{			
    use WithPagination;
    use IngresoForm;

    public $open = false;
    public $openEditar = false;
    public $openEliminar = false;

    #[Url]
    public $buscar = "";
    
    public $id = null;
    public $items = [];
    
    public $esTransferencia = false;

	public function mount(){
    	$this->estudiantes = Estudiante::all();	
    	$this->representantes = Representante::all();
    	$this->cargar();
    }				
    public function updatingBuscar()
    {	
        $this->resetPage();
    }	
   	public function updatingFormForma(){
   		$this->esTransferencia = true;
   	}	
    public function cargar()
    {	
        $this->items = Ingreso::
        where('cantidad', 'like', '%' . $this->buscar . '%')->
        orWhere('fecha', 'like', '%' . $this->buscar . '%')->
        orWhere('forma', 'like', '%' . $this->buscar . '%')->paginate();
    }	
    public function guardar(){
    	$this->form->validate();
    	$this->form->guardar($this->id);
    	session()->flash('message', 'Operacion exitosa!!.');	
    }					
    public function editar($id){
    	$this->open = true;
    	$this->id = $id;
    	$this->form->cargarEditar($id);
    }	
    public function borrar($id){
    	$this->id = $id;
    	$this->openEliminar = true;
    }	
    public function eliminar(){
    	Ingreso::find($this->id)->delete();
    	session()->flash('message', 'Operacion exitosa!!.');
    }	

    public function render()
    {	
        return view('livewire.ingreso-live');
    }	
}		