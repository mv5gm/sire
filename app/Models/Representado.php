<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Representado extends Model
{		
    use HasCreateOrUpdate;
    use HasFactory;
    	
    protected $fillable = ['representante_id','estudiante_id','relacion','parentesco','hogar_id'];

    public function representante(){
    	return $this->belongsTo(Representante::class);
    }	
    public function estudiante(){
    	return $this->belongsTo(Estudiante::class);
    }	
    public function hogar(){
    	return $this->belongsTo(Hogar::class);
    }	
}		