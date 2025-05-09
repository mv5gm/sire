<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;
use App\Models\Imparte;
use App\Models\Abono;
use App\Models\Nomina;

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
    public function nominas(){
    	return $this->hasMany(Nomina::class);
    }
    public function obtenerEstudiantesPorTipo(){
        return \DB::table('estudiantes')
            ->join('inscripcions', 'estudiantes.id', '=', 'inscripcions.estudiante_id')
            ->join('cursas', 'inscripcions.cursa_id', '=', 'cursas.id')
            ->join('impartes', 'cursas.id', '=', 'impartes.cursa_id')
            ->where('impartes.empleado_id', $this->id)
            ->select('estudiantes.tipo', \DB::raw('COUNT(*) as cantidad'))
            ->groupBy('estudiantes.tipo')
            ->get();
    }
    public function calcularSueldoMaestro($precioNormal,$precioEspecial){

        $estudiantesPorTipo = $this->obtenerEstudiantesPorTipo();
        
        if ($estudiantesPorTipo->isEmpty()) {
            return 0; // No hay estudiantes, sueldo es 0
        }

        $cantidadNormal = 0;
        $cantidadEspecial = 0;

        foreach ($estudiantesPorTipo as $tipo) {
            if ($tipo->tipo === 'Normal') {
            $cantidadNormal = $tipo->cantidad;
            } elseif ($tipo->tipo === 'Especial') {
            $cantidadEspecial = $tipo->cantidad;
            }
        }

        $estudiantesPorTipo = [
            (object) ['tipo' => 'Normal', 'cantidad' => $cantidadNormal],
            (object) ['tipo' => 'Especial', 'cantidad' => $cantidadEspecial],
        ];

        $sueldo = $estudiantesPorTipo[0]->cantidad * $precioNormal + $estudiantesPorTipo[1]->cantidad * $precioEspecial;

        return $sueldo;
    }
    public static function tipoBanco(){
        $enumValues = \DB::select("SHOW COLUMNS FROM empleados LIKE 'banco'");
        $type = $enumValues[0]->Type; // Obtiene el tipo de la columna (enum(...))

        // Extraer los valores del ENUM
        preg_match("/^enum\((.*)\)$/", $type, $matches);
        $values = explode(",", str_replace("'", "", $matches[1]));

        return $values;
    }
}