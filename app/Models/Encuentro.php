<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Encuentro extends Model
{
    use HasCreateOrUpdate;
    use HasFactory;

    public function imparte(){
    	return $this->belongsTo(Imparte::class);
    }
}
