<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = ['cedula','nombre','segundo','paterno','materno','lugar','fecha','sexo','cursa_id'];

    public function representados(){
    	return $this->hasMany(Representado::class);
    }
    public function inscripcions(){
    	return $this->hasMany(Inscripcion::class);
    }
    public function mensualidades(){
    	return $this->hasMany(Mensualidad::class);
    }
}
