<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Nomina;
use App\Models\Empleado;
use Illuminate\Support\Facades\Storage;

class NominaForm extends Form
{
    public $id;
    public $mes;
    public $anio;
    public $horas;
    public $matricula;
    public $empleado_id;
    public $cantidad;
    public $tipo;
    public $forma;
    public $quincena;

    public $texto;

    public $open = false;
    public $openEliminar = false;

    public function editar($id){
        $this->id = $id;
        
        $item = Nomina::findOrFail($id);
        $this->fill($item->toArray());
    }
    public function guardar(){

        if(empty($this->id)){
            Nomina::create($this->all());
        }
        else{
            Nomina::findOrFail($this->id)->update($this->all());    
        }
    }
    
    public function guardarNomina($cantidades, $tipo, $mes, $anio, $quincena)
    {   
        $quincena = $tipo == 'Mensual' ? null : $quincena;

        $filePath = public_path('nomina.txt');
        $fileHandle = fopen($filePath, 'w');

        $encabezado = "GRAN MARISCAL DE AYACUCHO\n";

        $this->texto = $encabezado;

        fwrite($fileHandle, $encabezado);

        \DB::transaction(function () use ($cantidades, $mes, $anio, $quincena, $tipo, $fileHandle) {
            foreach ($cantidades as $key => $cantidad) {
                Nomina::create([
                    'mes' => $mes,
                    'anio' => $anio,
                    'empleado_id' => $key,
                    'cantidad' => $cantidad,
                    'quincena' => $quincena,
                    'tipo' => $tipo,
                    'forma' => 'Transferencia',
                ]);

                $empleado = Empleado::find($key);
                $cuenta = $empleado->cuenta;
                $tipo_cuenta = $empleado->tipo_cuenta;

                $line = "Cantidad: $cantidad, Cuenta: $cuenta, Tipo de cuenta: $tipo_cuenta\n";
                $this->texto .= $line;
                fwrite($fileHandle, $line);
            }
        });

        fclose($fileHandle);

        // Redirigir a la ruta de descarga
        //return redirect()->route('descargar.nomina');
    }

    public function rules(){
        return [
        'mes' => 'required|integer|min:1|max:12',
        'anio' => 'required|integer|min:2000|max:3100',
        'horas' => 'nullable|integer|min:1|max:1000|required_if:tipo,Docente',
        'matricula' => 'nullable|integer|min:1|max:1000|required_if:tipo,Matricula',
        'empleado_id' => 'required|exists:empleados,id',
        'forma' =>'required|in:Divisa,Transferencia,Efectivo',
        'tipo' =>'required|in:Quincenal,Mensual',
        'quincena' =>'nullable|in:Primera,Segunda',
        'cantidad' =>'required|decimal:0,2',
        ];
    }
    public function validationAttributes(){
        return [
            'mes' => 'Mes',
            'anio' => 'Año',
            'horas' => 'Horas',
            'matricula' => 'Matricula',
            'empleado_id' => 'Empleado',
            'forma' => 'Forma de Pago',
            'tipo' => 'Tipo de Nomina',
        ];
    }    
}           