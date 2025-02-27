<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Parroquia extends Model
{
    /** @use HasFactory<\Database\Factories\ParroquiaFactory> */
    use HasCreateOrUpdate;
    use HasFactory;

    public function municipio(){
        return $this->belongsTo(Municipio::class);
    }
}
