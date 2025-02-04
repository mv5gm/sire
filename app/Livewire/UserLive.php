<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Livewire\Forms\UserForm;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserLive extends Component
{	
    use WithPagination;

    public $id;
    public $open = false;
    public $openEditar = false;
    public $openEliminar = false;
    public $divMostrarPassword = false;
    
    public $roles = [];
    
    #[Url]
    public $buscar = "";

    public UserForm $form;
    
    public function updatingBuscar()
    {
        $this->resetPage();
    }
    public function updatingRoles()
    {

    }

    public function updating(){
        
    }

    public function mount(){
    		
    }	

    public function render()
    {		
    	$items = User::where('name','like','%'.$this->buscar.'%')->paginate();

    	$rolitos = Role::all();

        return view('livewire.user-live',compact('rolitos'))->with('items',$items);
    }	
    public function registrar(){

        $this->form->validate();

        $this->form->password = password_hash($this->form->password, PASSWORD_DEFAULT);
        
        $user = $this->form->guardar();

        $user->syncRoles($this->roles);

        $this->form->reset();

        $this->open = false;

        $this->dispatch('success');

        $this->resetPage();
    }       
    public function editar($id){
        
    	//dd( User::find($id)->getRoleNames() );
        $this->form->reset($id);

        $this->id = $id;

        $this->resetValidation();

        $this->openEditar = true;
        
        $this->form->editar($id);

        $this->roles = User::find($id)->getRoleNames();
    }       
    public function actualizar(){

        $this->form->validate();
        
        $user = $this->form->actualizar($this->divMostrarPassword);
		
		$user->syncRoles($this->roles);
        
        $this->openEditar = false;
        
        $this->dispatch('success');
    }   
    public function borrar($id)
    {       
        $this->id = $id;
        $this->openEliminar = true;
    }       
    public function eliminar(){
            
        $item = User::find($this->id);

        $item->delete();   

        $this->reset(['id','openEliminar']);
    }   
    public function mostrarPassword (){
        $this->divMostrarPassword = !$this->divMostrarPassword;
    }   
}       