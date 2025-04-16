<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Nomina extends Model
{
    /** @use HasFactory<\Database\Factories\NominaFactory> */
    use HasCreateOrUpdate;
    use HasFactory;

    protected $fillable = ['mes','anio','horas','matricula','empleado_id'];
}
