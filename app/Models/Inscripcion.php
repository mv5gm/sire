<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Inscripcion extends Model
{
    use HasCreateOrUpdate;
    use HasFactory;

    protected $fillable = ['id','estudiante_id','cursa_id'];

    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }
    public function cursa(){
        return $this->belongsTo(Cursa::class);
    }
}
