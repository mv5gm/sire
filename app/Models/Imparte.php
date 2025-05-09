<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Imparte extends Model
{
    use HasCreateOrUpdate;
    use HasFactory;

    protected $fillable = ['empleado_id','cursa_id','saber','momento'];

    public function empleado(){
    	return $this->belongsTo(Empleado::class);
    }
    public function encuentros(){
    	return $this->hasMany(Encuentro::class);
    }
    public function cursa(){
    	return $this->belongsTo(Cursa::class);
    }
}