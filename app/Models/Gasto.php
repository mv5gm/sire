<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCreateOrUpdate;

class Gasto extends Model
{
    use HasCreateOrUpdate;
    use HasFactory;

    protected $fillable = [ 'descripcion','cantidad','forma','dolar' ];
}