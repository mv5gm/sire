<?php 	
		
namespace App\Models;
	
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Representante extends Model
{	
    use HasCreateOrUpdate;
    use HasFactory;

    protected $fillable = ['cedula','nombre','segundo','paterno','materno','telefono','telefono_movil','estado_civil','condicion_laboral','oficio','direccion_trabajo','direccion_habitacion','lugar_nacimiento','fecha','email','nivel_academico'];

    public function representados(){
    	return $this->hasMany(Representado::class);
    }
}	