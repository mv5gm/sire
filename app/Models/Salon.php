<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Salon extends Model
{
    use HasCreateOrUpdate;
    use HasFactory;

    protected $fillable = ['nombre'];

    public function cursas(){
        return $this->hasMany(Cursa::class);
    }

}
