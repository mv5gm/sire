<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensualidad extends Model
{
    /** @use HasFactory<\Database\Factories\MensualidadFactory> */
    use HasFactory;
    
    protected $fillable = ['mes','anio','porcentaje','exonerado'];
    
    public function pagos(){
    	return $this->belongsToMany(Pago::class);
    }
}
