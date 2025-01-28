<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Livewire\Forms\RoleForm;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
		
class RoleLive extends Component
{		
    use WithPagination;

    public $id;
    public $name;
    public $buscar; 
    public $open = false; 
    public $openEditar = false; 
    public $openEliminar = false; 
    public $roles = []; 
    public RoleForm $form; 

    public function updatingBuscar(){
    	$this->resetPage();
    }	
    public function render()
    {	
    	$items = Role::paginate();
        $permisos = Permission::all();

        return view('livewire.role-live',compact('items'))->with('permisos',$permisos);
    }	
    public function registrar(){
    	
    	$this->validate();
    	
    	$rol = Role::create(['name' => $this->name]);

    	$rol->syncPermissions($this->roles);
    	
    	$this->open = false;
    	
    	$this->dispatch('success');
    }	
    public function editar($id){
    	$this->openEditar = true;
    	$this->id = $id;
    	$this->roles = Role::find($id)->permissions->pluck('name');

    	//dd($this->roles);
    }	
    public function actualizar(){
    	
    	$item = Role::find($this->id);
    	
    	$item->update(['name'=>$this->name]);

    	$item->syncPermissions($this->roles);
    	
    	$this->openEditar = false;
    	
    	$this->dispatch('success');
    }	
    public function borrar($id){

    	$this->openEliminar = true;
    	$this->id = $id;
    }	
    public function eliminar(){
    	
    	Role::find($this->id)->delete();
    	$this->openEliminar = false;

    	$this->dispatch('success');
    }	
    public function rules(){
    	return [
    		'name' => 'required|min:3|max:50'
    	];
    }	
}		