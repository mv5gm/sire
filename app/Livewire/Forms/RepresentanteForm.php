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
    public $nivel_ingreso;
    public $email;

    public function guardar(){
        
        $this->validate();
        
        return Representante::createOrUpdate($this->all());
    }
    public function editar($id){

    	$this->id = $id;

        $item = Representante::find($id);

        $this->fill($item->toArray());
    }		

    public function rules(){
        return [
            'cedula' =>'required|unique:representantes,cedula,'.$this->id.'|integer|min:1000000|max:100000000',
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
            'nivel_academico' =>'required|in:ninguno,primaria,secundaria,universitario',
            'nivel_ingreso' =>'nullable|string|max:100'
        ];  
    }
    public function validationAttributes(){
        return [
            'cedula' => 'cedula de representante',
            'nombre' => 'nombre de representante',
            'segundo' => 'segundo nombre de representante',
            'paterno' => 'primer apellido de representante',
            'materno' => 'segundo apellido de representante',
            'estado_civil' => 'estado civil de representantes',
            'condicion_laboral' =>'Condicion laboral de representante',
            'oficio' =>'Oficio de representante',
            'direccion_habitacion' =>'Direccion de Habitacion de representante',
            'direccion_trabajo' =>'direccion de trabajo de representante',
            'lugar_nacimiento' =>'lugar de nacimiento de representante',
            'fecha' =>'fecha de nacimiento de representante',
            'telefono' =>'telefono fijo de representante',
            'telefono_movil' => 'telefono movil de representante',
            'email' =>'Correo Electronico de representante',
            'nivel_academico' =>'Nivel academico de representante',
            'nivel_ingreso' =>'nivel de ingreso de representante',
        ];
    }
}
