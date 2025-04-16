<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Empleado extends Model
{
    use HasCreateOrUpdate;
    use HasFactory;

    protected $fillable = ['cedula','nombre','segundo','paterno','materno','direccion','horas','tipo','banco','cuenta','tipo_cuenta','matricula','sueldo'];

    public function impartes(){
    	return $this->hasMany(Imparte::class);
    }
    public function abonos(){
    	return $this->hasMany(Abono::class);
    }
}