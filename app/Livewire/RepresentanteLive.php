<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Representante;
use App\Models\Representado;
use App\Models\Estudiante;
use App\Models\Hogar;
use App\Livewire\Forms\RepresentanteForm;
use App\Livewire\Forms\RepresentadoForm;
use App\Livewire\Forms\HogarForm;
use App\Livewire\Forms\AsignarEstudianteRepresentante;
use Livewire\WithPagination;

class RepresentanteLive extends Component
{   
    use WithPagination;

    public $open = false;
    public $openEditar = false;
    public $openEliminar = false;
    public $asignarEstudiante = false;
    public $hogarRegistrado = false;

    #[Url]
    public $buscar = "";
    #[Url]
    public $buscarEstudiante = "";
        
    public RepresentanteForm $form;
    public RepresentadoForm $representado;
    public HogarForm $hogar;
            
    public $idBorrar;
    public $idBorrarRepresentado;
    public $estudiantes;
    public $hogars = [];
    public $hogar_id;

    public $representante_id;
    public $estudiantes_representados = [];

    public $openRepresentado = false;
    public $openEliminarRepresentado = false;

    public function mount(){
        $this->estudiantes = Estudiante::all();
        $this->hogars = Hogar::join('representados', 'representados.hogar_id', '=', 'hogars.id')
            ->join('representantes', 'representados.representante_id', '=', 'representantes.id')
            ->select('hogars.id', 'representantes.nombre as nombre', 'representantes.paterno as paterno', 'representantes.cedula as cedula','representados.relacion as relacion')
            ->where('representados.relacion','Legal')
            ->get()->toArray();
        //dd($this->hogars);
    }   
    public function updatingBuscar()
    {
        $this->resetPage();
    }
    public function render()
    {   
        $this->estudiantes = Estudiante::select('id','cedula','nombre','paterno')->get();
    	
        $items = Representante::orWhere('nombre','like','%'.$this->buscar.'%')->orWhere('cedula','like','%'.$this->buscar.'%')->with('representados')->paginate(10);
        
        return view('livewire.representante-live',compact('items'));
    }   
    public function registrar(){
        $this->resetValidation();
        $this->open = true;
        $this->form->reset();
    }
    public function guardar(){
        
        $this->form->guardar();

        $this->form->reset();

        $this->open = false;

        $this->dispatch('success',['mensaje'=>'Operacion exitosa']);

        $this->resetPage();
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
            
        $item = Representante::find($this->idBorrar);

        $item->delete();  

        $this->reset(['idBorrar','openEliminar']);
    }
    public function representadoVer($id){     
    
        $this->representante_id = $id;

        $this->reset(['estudiantes_representados']);
        $this->openRepresentado = true;

        $this->estudiantes_representados = Representado::join('estudiantes', 'representados.estudiante_id', '=', 'estudiantes.id')
            ->join('representantes', 'representados.representante_id', '=', 'representantes.id')
            ->where('representantes.id', $id)
            ->select('representados.id', 'estudiantes.nombre', 'estudiantes.paterno', 'estudiantes.cedula','representados.relacion')
            ->get();      
    }	
    public function representadoGuardar(){   
        //dd($this->hogarRegistrado);

        \DB::beginTransaction();

        try {
            
            if($this->hogarRegistrado){
                $hogar_id = $this->hogar_id;
            }  
            else{
                $this->hogar->validate();
                $hogar_id = $this->hogar->guardar()->id;
            }   

            $this->representado->representante_id = $this->representante_id;
            $this->representado->hogar_id = $hogar_id;
            $this->representado->validate();
            $this->representado->guardar();
            \DB::commit();
            $this->dispatch('success',['message'=>'Operacion exitosa!']);
            $this->representadoVer($this->representante_id);

            $this->hogar->reset();
            $this->representado->reset();

        } catch (\Exception $e) {
            \DB::rollBack();
            //dd($e->getMessage());
            $this->dispatch('error', ['message' => 'Ocurrió un error: ' . $e->getMessage()]);
        }
    }           
    public function borrarRepresentado($id){
        //dd('iolap');
        $this->idBorrarRepresentado = $id;
        $this->openEliminarRepresentado = true;
    }   
    public function eliminarRepresentado(){
        Representado::find($this->idBorrarRepresentado)->delete();
        $this->dispatch('success',['message'=>'Operacion exitosa!']);
        $this->reset(['openEliminarRepresentado','idBorrarRepresentado']);
        
        $this->representadoVer($this->representante_id);
    }   	
}       