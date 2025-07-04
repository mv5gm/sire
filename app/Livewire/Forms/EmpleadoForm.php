<?php 	
		
namespace App\Livewire\Forms;
		
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Empleado;
		
class EmpleadoForm extends Form
{	
    public $id;
    public $cedula;
    public $nombre;
    public $segundo;
    public $paterno;
    public $materno;
    public $direccion;
    public $tipo;
	public $horas;
	public $matricula;
    public $banco;
    public $cuenta;
    public $tipo_cuenta;
    public $sueldo;
    
    public function guardar(){
    	
		if(empty($this->id)){
            $empleado = Empleado::create($this->all());
			$this->id = $empleado->id;
        }
        else{
            Empleado::findOrFail($this->id)->update($this->all());    
        }
    }		
    public function editar($id){

    	$this->id = $id;

        $item = Empleado::findOrFail($id);
        $this->fill($item->toArray());
    }	

    public function rules(){
    	
    	return [	
    		'cedula' => 'required|integer|min:1000000|max:100000000',
    		'nombre' => 'required|min:3|max:100',
    		'segundo' => 'required|min:3|max:100',
    		'paterno' => 'required|min:3|max:100',
    		'materno' => 'required|min:3|max:100',
    		'direccion' => 'required|min:3|max:100',
    		'horas' => 'nullable|integer|min:1|max:1000|required_if:tipo,Docente',
			'sueldo' => 'nullable|decimal:0,2|min:1|required_if:tipo,Administrativo,Obrero',
    		'tipo' => 'required|in:Obrero,Docente,Maestro,Administrativo',
    		'banco' => 'required|in:BANCO DE VENEZUELA,BANCO CENTRAL DE VENEZUELA,BANCO DEL TESORO,BANCO DEL COMERCIO EXTERIOR (BANCOEX),BANCO DE EXPORTACION Y COMERCIO,BANESCO,BANCO INDUSTRIAL DE VENEZUELA,BANCO BICENTENARIO,BANCO PROVINCIAL,CITIBANK SUCURSAL VENEZUELA,BANCO OCCIDENTAL DEL DESCUENTO,CORP BANCA,BANCO EXTERIOR,BANPLUS,BANCO NACIONAL DEL CREDITO,BANCO ACTIVO,BANCO DEL CARIBE,BANCO FONDO COMUN,BANCO MERCANTIL,100% BANCO,BANCO SOFITASA,BANCO ESPIRITU SANTO,BANCO PLAZA,BANFANB',
			'cuenta' => 'required|unique:empleados,cuenta,'.$this->id.'|digits:20',
    		'tipo_cuenta' => 'required|in:Ahorro,Corriente,Digital'
    	];	
    }			

    public function validationAttributes(){
    	return [
    		'nombre' => 'Primer Nombre',
    		'segundo' => 'Segundo Nombre',
    		'paterno' => 'Primer Apellido',
    		'materno' => 'Segundo Apellido',
    		'horas' => 'Cantidad de horas por mes',
    		'cuenta' => 'Numero de cuenta',
    		'tipo_cuenta' => 'Tipo de cuenta',
    	];	
    }		
}			