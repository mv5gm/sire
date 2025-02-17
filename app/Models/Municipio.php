<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    /** @use HasFactory<\Database\Factories\MunicipioFactory> */
    use HasFactory;

    public function estado(){
        return $this->belongsTo(Estado::class);
    }
    public function parroquias(){
        return $this->hasMany(Parroquia::class);
    }
}
