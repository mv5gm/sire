<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Documento extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentoFactory> */
    use HasCreateOrUpdate;
    use HasFactory;

    public function estudiante(){
        return $this->belongTo(Estudiante::class);
    }
}
