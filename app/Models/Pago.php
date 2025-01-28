<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Barryvdh\DomPDF\Facade\Pdf;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = ['cantidad','dolar','fecha','forma','representante_id','estudiante_id','tipo','aescolar_id'];

    public function mensualidades(){
    	return $this->hasMany(Mensualidad::class);
    }
    public function representante(){
    	return $this->belongsTo(Representante::class);
    }
}
