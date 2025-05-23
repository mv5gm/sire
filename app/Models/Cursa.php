<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cursa;
use App\Traits\HasCreateOrUpdate;

class Cursa extends Model
{
    use HasCreateOrUpdate;
    use HasFactory;

    protected $fillable = ['nivel_id','salon_id','aescolar_id','seccion_id'];
    protected $table = 'cursas';

   public function inscripcions(){
        return $this->hasMany(Inscripcion::class);
    }
    public function aescolar(){
        return $this->belongsTo(Aescolar::class);
    }
    public function seccion(){
        return $this->belongsTo(Seccion::class);
    }
    public function nivel(){
        return $this->belongsTo(Nivel::class);
    }
    public function salon(){
        return $this->belongsTo(Salon::class);
    }
    public static function crear($nivel_id,$salon_id,$aescolar_id,$seccion_id){

        $result = Cursa::where('nivel_id',$nivel_id)->where('salon_id',$salon_id)->where('aescolar_id',$aescolar_id)->where('seccion_id',$seccion_id)->first();

        if($result ==null){    
            
            $res = Cursa::create([
                'nivel_id' => $nivel_id ,
                'salon_id' => $salon_id ,
                'aescolar_id' => $aescolar_id ,
                'seccion_id' => $seccion_id
            ]);
            return $res->id;
        }
        return $result->id;
    }
    
    public static function obtener($aescolar_id, $nivel_id, $seccion_id, $salon_id)
    {
        return  Cursa::where('nivel_id',$nivel_id)
                ->where('salon_id',$salon_id)
                ->where('aescolar_id',$aescolar_id)
                ->where('seccion_id',$seccion_id)
                ->first();
    }   
    public static function scopeBuscar($query, $aescolarId, $nivelId, $seccionId, $salonId)
    {
        return $query->where('aescolar_id', $aescolarId)
                     ->where('seccion_id', $seccionId)
                     ->where('nivel_id', $nivelId)
                     ->where('salon_id', $salonId);
    } 
}
