<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingresos extends Model
{
    /** @use HasFactory<\Database\Factories\IngresosFactory> */
    use HasFactory;
    
    protected $fillable = [ 'cantidad','tipo','dolar','forma','fecha','codigo' ];
}
