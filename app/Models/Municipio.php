<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Municipio extends Model
{
    /** @use HasFactory<\Database\Factories\MunicipioFactory> */
    use HasCreateOrUpdate;
    use HasFactory;

    public function estado(){
        return $this->belongsTo(Estado::class);
    }
    public function parroquias(){
        return $this->hasMany(Parroquia::class);
    }
}
