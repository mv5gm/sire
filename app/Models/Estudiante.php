<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;
use Illuminate\Support\Facades\DB;

class Estudiante extends Model
{
    use HasCreateOrUpdate;
    use HasFactory;

    protected $fillable = ['cedula','nombre','segundo','paterno','materno','lugar','fecha','sexo','parroquia_id','institucion_procedencia','lentes','tratamiento','vive_con','parto','alergias','tipo'];

    public static function obtenerCursa($estudianteId)
    { 
        $cursa = DB::table('inscripcions')
        ->join('cursas', 'inscripcions.cursa_id', '=', 'cursas.id')
        ->where('inscripcions.estudiante_id', $estudianteId)
        ->orderBy('inscripcions.id', 'desc')
        ->select('cursas.*')
        ->first();

        return $cursa;
    }

    public static function registrarInscripcion($estudianteId, $aescolarId, $seccionId, $nivelId)
    {
        // Buscar la cursa por aescolar_id, seccion_id y nivel_id
        $cursa = DB::table('cursas')
            ->where('aescolar_id', $aescolarId)
            ->where('seccion_id', $seccionId)
            ->where('nivel_id', $nivelId)
            ->first();

        if ($cursa) {
            // Actualizar la inscripción con el cursa_id y estudiante_id
            Inscripcion::where('estudiante_id', $estudianteId)
                ->update(['cursa_id' => $cursa->id]);
                
            return true;
        }

        return false; // No se encontró la cursa
    }

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
