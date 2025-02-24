<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoMes extends Model
{
    /** @use HasFactory<\Database\Factories\PagoMesFactory> */
    use HasFactory;

    protected $fillable = ['mes','anio','pago_id'];
    
    public function pago(){
    	return $this->belongsTo(Pago::class);
    }
}
