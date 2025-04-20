<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;
use App\Models\Empleado;

class Nomina extends Model
{
    /** @use HasFactory<\Database\Factories\NominaFactory> */
    use HasCreateOrUpdate;
    use HasFactory;

    protected $fillable = ['cantidad','mes','anio','horas','matricula','empleado_id','forma','tipo','quincena'];

    public function empleado(){
        return $this->belongsTo(Empleado::class);
    }

}
