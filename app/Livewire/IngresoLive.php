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
    public $openEditar = false;
    public $openEliminar = false;
    public $estudiantes;	
    public $representantes;

    #[Url]
    public $buscar = "";
    
    public $id = null;
    
    public $esTransferencia = false;
    
    public function abrirModal(){
        $this->id = null;
        $this->open = true;
    }
	public function mount(){
    	$this->estudiantes = Estudiante::all();	
    	$this->representantes = Representante::all();
    }				
    public function updatingBuscar()
    {	
        $this->resetPage();
    }	
   	public function updatedFormForma(){

        $this->esTransferencia = ($this->form->forma == 'Transferencia') ? true : false;
        //dd($this->esTransferencia);
   	}	
    public function updatedFormRepresentanteId(){
        $this->estudiantes = Estudiante::with('representados.representante')
            ->whereHas('representados.representante', function ($query) {
            $query->where('id', $this->form->representante_id);
            })->get();
    }
    public function guardar(){
    	$this->form->validate();
    	$this->form->save($this->id);
        $this->dispatch('success', ['message' => 'Guardado con éxito']);

        $this->id = null;	
        $this->open = false;	
    }					
    public function editar($id){
        $this->open = true;
    	$this->id = $id;
    	$this->form->load($id);
    }	
    public function borrar($id){
    	$this->id = $id;
    	$this->openEliminar = true;
    }	
    public function eliminar(){
    	Ingreso::find($this->id)->delete();
        $this->dispatch('success', ['message' => 'Eliminado con éxito']);
        $this->id = null;
        $this->openEliminar = false;
    }	

    public function render()
    {	
        $items = Ingreso::
        where('cantidad', 'like', '%' . $this->buscar . '%')->
        orWhere('fecha', 'like', '%' . $this->buscar . '%')->
        orWhere('forma', 'like', '%' . $this->buscar . '%')->paginate();

        return view('livewire.ingreso-live',compact('items'));
    }	
}		