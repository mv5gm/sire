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

    public $mostrarPassword = false;

    public function guardar(){
            
        return User::create($this->all());
    }   
    public function editar($id){
    	$item = User::find($id);
    	$this->id = $item->id;
    	$this->name = $item->name;
    	$this->email = $item->email;
    }	  
    public function actualizar($mostrarPassword){
    	
        //dd($mostrarPassword);

        $this->mostrarPassword = $mostrarPassword;

    	$item = User::find($this->id);
    	
    	$item->update($this->all());
    	
    	return $item;
    }	      
    public function rules(){
    	
        $val = '';

        if ($this->mostrarPassword) {
            $val = 'required|min:8|max:100';        
        }
        else {
            $val = '';
        }           
    	return [   
    		'name' => 'required|min:3|max:100',
    		'email' => 'required|unique:users,id,'.$this->id.'|min:3|max:100',
    		'password' => $val
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