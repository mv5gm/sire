<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empleado;
use App\Models\Nivel;
use App\Models\Seccion;
use App\Models\Aescolar;
use App\Models\Imparte;
use App\Models\Cursa;
use App\Livewire\Forms\EmpleadoForm;
use App\Livewire\Forms\CursaForm;

class EmpleadoLive extends Component
{	
    public $open = false;
    public $openEliminar = false;
    public $openEliminarImparte = false;
    public $openNomina = true;
    
    public $id;
    public $idBorrar;
    public $idBorrarImparte;

    public $nivels = [];
    public $seccions = [];
    public $aescolars = [];
    public $impartes = [];
    public $bancos = [];

    public $buscar = "";

    public EmpleadoForm $form;
    public CursaForm $cursa;

    public $empleados;
    
    public function mount(){
        $this->empleados = Empleado::all();
        $this->nivels = Nivel::all();
        $this->seccions = Seccion::all();
        $this->aescolars = Aescolar::all();
        $this->bancos = Empleado::tipoBanco();
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
        $this->id = null;

        try {
            \DB::transaction(function () {
                $this->form->guardar();

                //asignar el id del empleado a la tabla impartes
                if ($this->form->tipo == 'Maestro') {
                    $cursa = Cursa::obtener($this->cursa->aescolar_id, $this->cursa->nivel_id, $this->cursa->seccion_id, $this->cursa->salon_id);

                    if (!empty($cursa)) {
                    Imparte::create([
                        'momento' => 'I',
                        'saber' => 'Educacion Basica',
                        'empleado_id' => $this->form->id,
                        'cursa_id' => $cursa->id,
                    ]);
                    } else {
                    throw new \Exception('Esta Seccion no esta registrada');
                    }
                }
            });

            $this->form->reset();
            $this->open = false;
            $this->dispatch('success', ['message' => 'Guardado con exito']);

        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => $e->getMessage()]);
        }
    }
    public function editar($id){
        
        $this->id = $id;

        $this->resetValidation();

        $this->open = true;

        $this->form->editar($id);

        $this->impartes = null;
        $this->impartes = Imparte::where('empleado_id',$id)->get();
        //dd($this->impartes[0]->cursa->nivel->nombre);
    }       
       
    public function borrar($id)
    {       
        $this->idBorrar = $id;
        $this->openEliminar = true;
    }
    public function borrarImparte($id)
    {       
        $this->idBorrarImparte = $id;
        $this->openEliminarImparte = true;
    }

    public function eliminar(){
            
        $item = Empleado::find($this->idBorrar);

        $item->delete();  

        $this->reset(['idBorrar','openEliminar']);

        $this->dispatch('success');
    }

    public function eliminarImparte(){
            
        $item = Imparte::find($this->idBorrarImparte);

        $item->delete();  

        $this->reset(['idBorrarImparte','openEliminarImparte']);

        $this->dispatch('success');

        $this->editar($this->id);
    }
}		