<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Ingreso;
use App\Models\Pago;
use App\Models\PagoMes;

class IngresoForm extends Form
{
	public $cantidad;
	public $dolar;
	public $forma;
    public $esPago = false;
    public $estudiante_id;
    public $representante_id;
    public $tipoPago;
    public $meses = [];

    public $tiposPago = ['Mensualidad','Uniformes','Aranceles'];

    // Opciones para los meses
    public $meses = ['Enero'=>1, 'Febrero'=>2, 'Marzo'=>3, 'Abril'=>4, 'Mayo'=>5, 'Junio'=>6,
        'Julio'=>7, 'Agosto'=>8, 'Septiembre'=>9, 'Octubre'=>10, 'Noviembre'=>11, 'Diciembre'=>12];
}
