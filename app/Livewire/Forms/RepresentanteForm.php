<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;
use App\Models\Representante;

class RepresentanteForm extends Form
{
    public $id;
    public $cedula;
    public $nombre;
    public $segundo;
    public $paterno;
    public $materno;
    public $estado_civil;
    public $condicion_laboral;
    public $oficio;
    public $direccion_habitacion;
    public $direccion_trabajo;
    public $lugar_nacimiento;
    public $fecha;
    public $telefono;
    public $telefono_movil;
    public $nivel_academico;
    public $email;

    public function guardar(){
        
        $this->validate();
        
        return Representante::createOrUpdate($this->all());
    }
    public function editar($id){

    	$this->id = $id;

        $item = Representante::find($id);

        $this->cedula = $item->cedula;
        $this->nombre = $item->nombre;
        $this->segundo = $item->segundo;
        $this->paterno = $item->paterno;
        $this->materno = $item->materno;
        $this->direccion = $item->direccion;
        $this->telefono = $item->telefono;
    }		

    public function actualizar(){

		$item = Representante::find($this->id);

        $item->update($this->all());

        $this->reset();
	        
    }
    public function rules(){
        return [
            'cedula' =>'required|unique:representantes,cedula|integer|min:1000000|max:100000000',
            'nombre' =>'required|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚüÜ\s]+$/|min:3|max:50',
            'segundo' =>'nullable|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚüÜ\s]+$/|max:50',
            'paterno' =>'required|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚüÜ\s]+$/|min:3|max:50',
            'materno' =>'nullable|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚüÜ\s]+$/|max:50',
            'estado_civil' =>'required|in:Soltero(a),Casado(a),Divorciado(a),Viudo(a),Concubinato',
            'condicion_laboral' =>'required|in:Empleado(a),Desempleado(a)',
            'oficio' =>'required|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚüÜ\s]+$/|min:3|max:100',
            'direccion_habitacion' =>'required|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚüÜ0-9\s]+$/|min:3|max:100',
            'direccion_trabajo' =>'nullable|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚüÜ0-9\s]+$/|min:3|max:100',
            'lugar_nacimiento' =>'required|regex:/^[a-zA-ZÑñáéíóúÁÉÍÓÚüÜ0-9\s]+$/|min:3|max:100',
            'fecha' =>'required|date',
            'telefono' =>'nullable|regex:/^[0-9]+$/|max:11',
            'telefono_movil' => 'nullable|regex:/^[0-9]+$/|max:11',
            'email' =>'nullable|string|max:100',
            'nivel_academico' =>'required|in:ninguno,primaria,secundaria,universitario'
        ];  
    }
    public function validationAttributes(){
        return [
            'segundo' => 'segundo nombre',
            'paterno' => 'primer apellido',
            'materno' => 'segundo apellido'
        ];
    }
}
