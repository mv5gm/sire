<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;
use App\Models\User;


class UserForm extends Form
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $registro = true;

    public function guardar(){
        
        return User::create($this->all());
    	$this->registro = true;
    }
    public function editar($id){
    	$item = User::find($id);
    	$this->id = $item->id;
    	$this->name = $item->name;
    	$this->email = $item->email;
    }	
    public function actualizar(){
    	
    	$this->registro = false;
    	
    	$item = User::find($this->id);
    	
    	$item->update($this->all());
    	
    	return $item;
    	//$item->save();
    }	
    public function rules(){
    	
    	$val = '';
    	
    	if($this->registro){
    		$val = 'unique:users,email|';
    	}	

    	return [
    		'name' => 'required|min:3|max:100',
    		'email' => 'required|'.$val.'min:3|max:100',
    		'password' => 'required|min:8|max:100'
    	];
    }
    public function validationAttributes(){
    	return [ 
	    	'name' => 'Nombre',
	    	'email' => 'Correo',
	    	'password' => 'Contraseña'
    	];
    }
}
