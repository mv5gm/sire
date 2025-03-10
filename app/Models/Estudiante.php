<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Estudiante extends Model
{
    use HasCreateOrUpdate;
    use HasFactory;

    protected $fillable = ['cedula','nombre','segundo','paterno','materno','lugar','fecha','sexo','parroquia_id','institucion_procedencia','lentes','tratamiento','vive_con','parto','alergias'];

    public function representados(){
    	return $this->hasMany(Representado::class);
    }
    public function inscripcions(){
    	return $this->hasMany(Inscripcion::class);
    }
    public function mensualidades(){
    	return $this->hasMany(Mensualidad::class);
    }
    public function documentos(){
        return $this->hasMany(Documento::class);
    }
    public function incidencias(){
        return $this->hasMany(Incidencia::class);
    }
    public function mediciones(){
        return $this->hasMany(Medicion::class);
    }
}
