<?php 	
		
namespace App\Models;
	
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Representante extends Model
{	
    use HasCreateOrUpdate;
    use HasFactory;

    protected $fillable = ['cedula','nombre','segundo','paterno','materno','direccion','telefono'];

    public function representados(){
    	return $this->hasMany(Representado::class);
    }
}	