<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representado extends Model
{
    use HasFactory;
    
    protected $fillable = ['representante_id','estudiante_id'];

    public function representante(){
    	return $this->belongsTo(Representante::class);
    }
    public function estudiante(){
    	return $this->belongsTo(Estudiante::class);
    }
}
