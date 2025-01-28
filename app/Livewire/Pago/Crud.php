<?php

namespace App\Livewire\Pago;

use Livewire\Component;
use App\Models\Representante;
use App\Models\Representado;
use App\Models\Estudiante;
use App\Models\Pago;
use App\Models\Aescolar;
use App\Livewire\Forms\PagoRegistrar;
use App\Livewire\Forms\PagoEditar;
use App\Livewire\Forms\imprimirPago;
use Livewire\WithPagination;

class Crud extends Component
{
    public $open = false;
    public $openEditar = false;
    public $openEliminar = false;
    public $openReporte = false;
    public $representante_id;
    
    public $listaRepre;
    public $listaEstu;
    
    public $aescolars;

    public $idBorrar;

    public $buscar = "";

    public PagoRegistrar $registrarForm;
    public PagoEditar $editarForm;
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

    public function updated(){
        
        $consulta = Representante::where('id',$this->registrarForm->representante_id)->with('representados.estudiante')->first();

        if ($consulta != null){
            $this->listaEstu = $consulta->representados;        
        }

        //dd($this->listaEstu);
    }

    public function render()
    {
        //$items = Pago::with('representante')->with('tpago')->orWhereRelation('representante','cedula','like','%'.$this->buscar.'%')->orWhereRelation('representante','nombre','like','%'.$this->buscar.'%')->orderBy('cedula')->paginate(10);

        $items = Pago::select('pagos.*')
            ->join('representantes','representantes.id','=','pagos.representante_id')
            ->join('estudiantes','estudiantes.id','=','pagos.estudiante_id')
            ->orWhere('representantes.nombre','like','%'.$this->buscar.'%')
            ->orWhere('representantes.cedula','like','%'.$this->buscar.'%')
            ->orWhere('estudiantes.nombre','like','%'.$this->buscar.'%')
            ->orWhere('estudiantes.cedula','like','%'.$this->buscar.'%')
            ->orderBy('pagos.fecha')
            ->paginate();

        return view('livewire.pago.crud',compact('items'));
    }   

    public function registrar(){
        
        $this->registrarForm->validate();

        //dd($this->registrarForm);

        $this->registrarForm->guardar();

        //$this->registrarForm->reset();

        $this->open = false;

        $this->dispatch('success',['mensaje' => 'Operacion exitosa!']);
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