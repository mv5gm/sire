<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Pago;
use App\Models\PagoMes;

class PagoMesForm extends Form
{
    public $id;
    public $mes;
    public $anio;
    public $pago_id;

    public function guardar()
    {       
        $itemData = [
            'mes' => $this->mes,
            'anio' => $this->anio,
            'pago_id' => $this->pago_id,
        ];
        
        if( !empty( $this->id ) ){
            $item = PagoMes::find($id);
            $item->update($itemData);
            return $item;    
        }
        $pagoMes = PagoMes::create($itemData);
        
        $this->reset();
        
        return $pagoMes;
    }
    
    public function editar($id)
    {
        $item = Pago::find($id);
        $this->fill($item->toArray);
    }

    public function rules()
    {
        return [
            'mes' => 'required|in:Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre',
            'anio' => 'required|integer|min:1900|max:2100',
            'pago_id' => 'required|exists:pagos,id',
        ];
    }
}