<?php 		
			
namespace App\Models;
			
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\HasCreateOrUpdate;

class Ingreso extends Model
{			
    /** @use HasFactory<\Database\Factories\IngresosFactory> */
    use HasCreateOrUpdate;
    use HasFactory;
    		
    protected $fillable = [ 'cantidad','dolar','forma','fecha','codigo','descripcion' ];
    
    public function pagos(){
        return $this->hasMany(Pago::class);
    }

    public function scopePorMes($query)
    {		
        $consulta = $query->select(
                DB::raw('YEAR(fecha) as anio'),
                DB::raw('MONTH(fecha) as mes'),
                DB::raw('SUM(cantidad) as total')
            )			
            ->groupBy('anio', 'mes')
            ->orderBy('anio', 'asc')
            ->orderBy('mes', 'asc')->get();

        //dd($consulta);    

            // Procesar los resultados para obtener dos arreglos
        $meses = [];
        $cantidades = [];
        $mesesEspaniol = ['Enero','Febrero','Marzo','Abril','Mayo','junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

        foreach ($consulta as $ingreso) {
            $nombreMes = $mesesEspaniol[$ingreso['mes']+1];
            $meses[] = $nombreMes;
            $cantidades[] = $ingreso->total;
        }
        return [ 'meses'=>$meses ,'cantidades'=> $cantidades ];
    }		
}			