<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imparte extends Model
{
    use HasFactory;

    public function empleado(){
    	return $this->belongsTo(Empleado::class);
    }
    public function encuentros(){
    	return $this->hasMany(Encuentro::class);
    }
    public function cursa(){
    	return $this->hasMany(Encuentro::class);
    }
}