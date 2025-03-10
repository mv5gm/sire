<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Medicion extends Model
{
    /** @use HasFactory<\Database\Factories\MedicionFactory> */
    use HasFactory;
    use HasCreateOrUpdate;

    protected $fillable = ['talla','talla_camisa','talla_pantalon','talla_zapatos','peso','altura','estudiante_id'];

    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }
}
