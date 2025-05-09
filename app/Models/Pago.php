<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Traits\HasCreateOrUpdate;

class Pago extends Model
{
    use HasCreateOrUpdate;
    use HasFactory;

    protected $fillable = ['representante_id','estudiante_id','ingreso_id','tipo'];

    public function ingreso(){
    	return $this->belongsTo(Ingreso::class);
    }
    public function estudiante(){
    	return $this->belongsTo(Estudiante::class);
    }
    public function representante(){
    	return $this->belongsTo(Representante::class);
    }
    public function pagosMeses(){
    	return $this->hasMany(PagoMes::class);
    }
}
