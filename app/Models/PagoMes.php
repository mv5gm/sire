<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class PagoMes extends Model
{
    /** @use HasFactory<\Database\Factories\PagoMesFactory> */
    use HasCreateOrUpdate;
    use HasFactory;

    protected $fillable = ['mes','anio','pago_id'];
    
    public function pago(){
    	return $this->belongsTo(Pago::class);
    }
}
