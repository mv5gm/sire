<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aescolar extends Model
{
    use HasFactory;

    protected $fillable = ['inicio','final'];

    public function cursas(){
        return $this->hasMany(Cursa::class);
    }
}
