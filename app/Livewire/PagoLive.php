<?php
	
namespace App\Livewire;
	
use Livewire\Component;
use App\Models\Representante;
use App\Models\Representado;
use App\Models\Estudiante;
use App\Models\Pago;
use App\Models\Aescolar;
use App\Models\Mensualidad;
use App\Models\Mes;
use App\Livewire\Forms\PagoForm;
use App\Livewire\Forms\imprimirPago;
use Livewire\WithPagination;
		
class PagoLive extends Component
{		
    use WithPagination;

    public $open = false;
    public $openEditar = false;
    public $openEliminar = false;
    public $openReporte = false;
    public $mostrarCodigo = false;
    public $mostrarMeses = false;
    public $representante_id;
    public $estudiantes = [];
    public $meses = [];
    public $ahno;
    public $mes;
    
    public $listaRepre;
    public $listaEstu;
    
    public $aescolars;

    public $idBorrar;

    public $buscar = "";

    public PagoForm $registrarForm;
    public PagoForm $editarForm;
    public imprimirPago $imprimirForm;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function mount(){
        $this->listaRepre = Representante::all();
        $this->listaEstu = collect();
        $this->aescolars = Aescolar::all();
    }

    public function updatedRegistrarForm(){
        
        $consulta = Representante::where('id',$this->registrarForm->representante_id)->with('representados.estudiante')->first();

        if ($consulta != null){
            $this->listaEstu = $consulta->representados;        
        }   

        if( $this->registrarForm->forma == 'Transferencia'  ){
            $this->mostrarCodigo = true;
        }

        if( $this->registrarForm->tipo == 'Mensualidad'  ){
            $this->mostrarMeses = true;
        }	
    }		
    public function render()
    {		
    	$items = Pago::select('pagos.*')
            ->join('representantes','representantes.id','=','pagos.representante_id')
            ->orWhere('representantes.nombre','like','%'.$this->buscar.'%')
            ->orderBy('pagos.fecha')
            ->paginate();

        return view('livewire.pago-live',compact('items'));
    }		
    public function registrar(){

        //dd($this->registrarForm->codigo);

        if(count($this->estudiantes) == 0){
            dd('no hay estudiantes');
        }   
            
        $this->registrarForm->validate();

        $pago = $this->registrarForm->guardar();
            
        foreach ($this->estudiantes as $key) {
                    
            $mensualidad = new Mensualidad;
            $mensualidad->pago_id = $pago->id;
            $mensualidad->estudiante_id = $key;

            if($this->registrarForm->tipo == 'Mensualidad'){
                $meses = '';    
                $coma = '';
                foreach($this->meses as $key => $value){ 
                    if ($key > 0) {
                        $coma = ',';
                    }       
                    $meses = $meses.$coma.$value;
                }                    
                $mensualidad->meses = $meses;
            }           
            $mensualidad->save();
        }           

        $this->open = false;

        $this->dispatch('success');
    }               
    public function editar($id){
        
        $this->resetValidation();

        $this->openEditar = true;

        $this->editarForm->editar($id);
        
        $consulta = Representante::where('id',$this->editarForm->representante_id)->with('representados.estudiante')->first();

        if ($consulta != null){
            $this->listaEstu = $consulta->representados;        
        }
    }       
    public function actualizar(){

        $this->editarForm->actualizar();

        $this->openEditar = false;
        
        $this->dispatch('success',['mensaje' => 'Operacion exitosa!']);
    }   
    public function borrar($id)
    {       
        $this->idBorrar = $id;
        $this->openEliminar = true;
    }       
    public function eliminar(){
            
        $item = Pago::find($this->idBorrar);

        $item->delete();  

        $this->reset(['idBorrar','openEliminar']);

        $this->dispatch('success',['mensaje' => 'Operacion exitosa!']);
    }	
    public function reporte($representante_id){

        $this->representante_id = $representante_id;
        $this->openReporte = true;

        $consulta = Representante::where('id',$representante_id)->with('representados.estudiante')->first();

        if ($consulta != null){  
            $this->listaEstu = $consulta->representados;        
        }

    }   
    public function imprimir(){
        
        $this->imprimirForm->representante_id = $this->representante_id;
            
        $this->imprimirForm->validate();
        
        $this->imprimirForm->guardar();

        $this->reset(['openReporte']);

        $this->dispatch('success',['mensaje' => 'Operacion exitosa!']);
    }
}					