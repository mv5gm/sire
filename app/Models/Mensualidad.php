<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensualidad extends Model
{
    use HasFactory;

    public function estudiante(){
    	return $this->belongsTo(Estudiante::class);
    }
    public function pago(){
    	return $this->belongsTo(Pago::class);
    }
    public function mess(){
    	return $this->hasmany(Mes::class);
    }
}
