<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Estado extends Model
{
    /** @use HasFactory<\Database\Factories\EstadoFactory> */
    use HasCreateOrUpdate;
    use HasFactory;
    
    public function municipios(){
        return $this->hasMany(Municipio::class);
    }
}
