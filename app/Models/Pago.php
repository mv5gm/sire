<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Barryvdh\DomPDF\Facade\Pdf;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = ['cantidad','dolar','fecha','forma','representante_id','tipo','codigo'];

    public function mensualidades(){
    	return $this->hasMany(Mensualidad::class);
    }
    public function representante(){
    	return $this->belongsTo(Representante::class);
    }
    public function mes(){
    	return $this->hasmany(Mes::class);
    }
}
