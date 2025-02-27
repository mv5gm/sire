<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Aescolar extends Model
{
    use HasFactory;
    use HasCreateOrUpdate;

    protected $fillable = ['inicio','final'];

    public function cursas(){
        return $this->hasMany(Cursa::class);
    }
}
