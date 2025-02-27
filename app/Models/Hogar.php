<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Hogar extends Model
{			
    /** @use HasFactory<\Database\Factories\HogarFactory> */
    use HasCreateOrUpdate;
    use HasFactory;

    public function representados(){
    	return $this->hasMany(Representado::class);
    }	
}		