<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Hogar extends Model
{			
    /** @use HasFactory<\Database\Factories\HogarFactory> */
    use HasCreateOrUpdate;
    use HasFactory;

    protected $fillable = [ 'numero_mayores','numero_menores','numero_familias','numero_ambitos','representante_economico','gastos_separados','numero_dormitorios'];

    public function representados(){
    	return $this->hasMany(Representado::class);
    }	
}		