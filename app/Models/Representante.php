<?php 	
		
namespace App\Models;
	
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
	
class Representante extends Model
{	
    use HasFactory;

    protected $fillable = ['cedula','nombre','segundo','paterno','materno','direccion'];

    public function representados(){
    	return $this->hasMany(Representado::class);
    }
}	