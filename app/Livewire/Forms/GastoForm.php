<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Gasto;

class GastoForm extends Form
{
    public $id;
    public $descripcion;
    public $cantidad;
    public $tipo;
    public $dolar;

    public function guardar(){
    	Gasto::create($this->all());
    }
    public function actualizar(){
    	
    	Gasto::find($this->id)->update($this->all());
    }
    public function editar($id){
    	$this->id = $id;
    	$g = Gasto::find($id);
    	$this->descripcion = $g->descripcion;
    	$this->cantidad = $g->cantidad;
    	$this->tipo = $g->tipo;
    	$this->dolar = $g->dolar;
    }

    public function rules(){
    	$val = '';
        
        if ($this->tipo == 'Dolares') {
            $val = 'required|decimal:0,2';        
        }       

        return [
    		'descripcion' => 'required|min:3|max:100', 
    		'cantidad' => 'required|decimal:0,2|min:1|max:100', 
    		'tipo' => 'required|in:Dolares,Bolivares', 
    		'dolar' => $val, 
    	];
    }
}
