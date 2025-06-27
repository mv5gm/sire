<?php
	
namespace App\Livewire;
	
use Livewire\Component;
use App\Models\Representante;
use App\Models\Representado;
use App\Models\Estudiante;
use App\Models\Pago;
use App\Models\Aescolar;
use App\Models\Ingreso;
use App\Models\Mensualidad;
use App\Livewire\Forms\IngresoForm;
use App\Livewire\Forms\PagoForm;
use App\Livewire\Forms\MensualidadForm;
use App\Livewire\Forms\imprimirPago;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
		
class PagoLive extends Component
{		
    use WithPagination;

    public $open = false;
    public $openEliminar = false;
    public $openEditar = false;
    public $openEliminarIngreso = false;
    public $openEliminarMensualidad = false;
    
    public $representantes;
    public $representante_id;

    public $estudiantes = [];
    public $ingresos = [];
    public $ingresosRegistrados = [];
    public $ingresosEditar = [];
    public $mensualidadEditar;
    public $mensualidadesEditar = [];
    
    public $pago;
    public $pagos = [];

    public $id;
    public $idBorrar;
    public $idBorrarIngreso;
    public $idBorrarMensualidad;
    public $idEditarIngreso;

    public $buscar = "";

    public PagoForm $form;
    public IngresoForm $ingreso;
    public IngresoForm $ingresoEditar;
    public MensualidadForm $mensualidad;

    public function updatingBuscar()
    {
        $this->resetPage();
    }
    public function mount(){
        $this->representantes = Representante::all();
        $this->estudiantes = collect();
        $this->mensualidadEditar = [
            'mes' => '',
            'anio' => date('Y'),
            'porcentaje' => '100',
            'exonerado' => 'no',
        ];
        $this->ingresosRegistrados = Ingreso::all();
        $this->ingresoEditar->fecha = date('Y-m-d');
        //dd($this->ingresosRegistrados->toArray());
    }
		
    public function render()
    {		
        // Solo ingresos que no tengan pagos asociados
        $items = Pago::with('estudiante', 'representante')
            ->paginate();

        // Usamos la propiedad pública $ingresosDisponibles, que ya se actualiza con actualizarIngresosDisponibles()
        return view('livewire.pago-live', [
            'items' => $items]);
    }	    	

    public function guardar(){   

        DB::beginTransaction();
        try {
            $ingresoIds = [];
            foreach ($this->ingresos as $idx => $ingresoData) {
                $ingreso = Ingreso::create([
                    'cantidad' => $ingresoData['cantidad'],
                    'dolar' => $ingresoData['dolar'],
                    'fecha' => !empty($ingresoData['fecha']) ? $ingresoData['fecha'] : date('Y-m-d'),
                    'forma' => $ingresoData['forma'],
                    'codigo' => $ingresoData['codigo'],
                    'descripcion' => $ingresoData['descripcion'],
                ]);
                $ingresoIds[$idx] = $ingreso->id;
            }
            foreach ($this->pagos as $pagoData) {
                if ($pagoData['seleccionado'] == true) {
                    $nuevoPago = new Pago([
                        'representante_id' => $this->representante_id,
                        'estudiante_id' => $pagoData['estudiante_id'],
                        'tipo' => $pagoData['tipo'],
                        'exonerado' => $pagoData['exonerado'],
                        'seleccionado' => $pagoData['seleccionado'],
                    ]);
                    $nuevoPago->save();
                    // Asociar los ingresos seleccionados por índice
                    if (!empty($pagoData['ingresos'])) {
                        $ids = [];
                        foreach ($pagoData['ingresos'] as $indiceIngreso) {
                            if (isset($ingresoIds[$indiceIngreso])) {
                                $ids[] = $ingresoIds[$indiceIngreso];
                            }
                        }
                        $nuevoPago->ingresos()->attach($ids);
                    }
                    // Recorrer los meses y asociarlos al pago
                    if (!empty($pagoData['meses'])) {
                        foreach ($pagoData['meses'] as $mesData) {
                            $mensualidad = new Mensualidad([
                                'mes' => $mesData['mes'],
                                'anio' => $mesData['anio'],
                                'porcentaje' => $mesData['porcentaje'] ?? 100,
                                'exonerado' => $mesData['exonerado'] ?? 0,
                            ]);
                            $nuevoPago->mensualidads()->save($mensualidad);
                        }
                    }
                }
            }
            DB::commit();
            $this->open = false;
            $this->reset(['pagos', 'ingresos', 'representante_id']);
            $this->resetPage();
            $this->dispatch('success');
        } catch (\Exception $e) {
            
            DB::rollBack();
            dd($e->getMessage());
            $this->dispatch('error', ['mensaje' => 'Error al guardar: ' . $e->getMessage()]);
        }   
    }       

    public function editar($id){
        
        $this->resetValidation();
        $this->id = $id;
        $this->openEditar = true;

        $this->pago = Pago::with('representante','ingresos')->find($id);

        $this->ingresosEditar = $this->pago->ingresos;

        $this->mensualidadesEditar = $this->pago->mensualidads;
    }   
    public function borrar($id)
    {       
        $this->idBorrar = $id;
        $this->openEliminar = true;
    }       
    public function eliminar(){
            
        $item = Pago::find($this->idBorrar);

        // Eliminar mensualidades asociadas al pago
        // Asegúrate de que la relación esté bien definida en el modelo Pago como 'mensualidades'
        $item->mensualidads()->delete();

        // Asegúrate de que la relación esté bien definida en el modelo Pago como 'ingresos'
        $item->ingresos()->detach();

        $item->delete();  

        $this->reset(['idBorrar','openEliminar']);

        $this->dispatch('success');
    }

    public function updatedRepresentanteId(){
        $representante = Representante::with('representados.estudiante')
        ->where('id', $this->representante_id)
        ->first(); 

        // Si el representante existe, asignar los estudiantes a la propiedad $estudiantes
        if ($representante) {
            $this->estudiantes = $representante->representados->map(function ($representado) {
                return $representado->estudiante;
            })->toArray();

            $this->pagos = $representante->representados->map(function ($representado) {
                return [
                    'representado_id' => $representado->id,
                    'estudiante_id' => $representado->estudiante_id,
                    'tipo' => '',
                    'exonerado' => 'no',
                    'seleccionado' => '',
                    'meses' => [],
                    'ingresos' => [],
                ];
            })->toArray();      

        } else {
            $this->estudiantes = collect(); // Si no hay representante, asignar una colección vacía
        }       
        //dd($this->pagos);
    }       

    public function anadirMes($indicePago)
    {
        $this->pagos[$indicePago]['meses'][] = [
            'mes' => '',
            'anio' => date('Y'),
            'porcentaje' => '100',
            'exonerado' => 'no',
        ];
    }
    public function anadirIngreso(){
        $this->ingresos[] = [
           'cantidad' => '',
            'dolar' => '',
            'fecha' => date('Y-m-d'),
            'forma' => '',
            'codigo' => '',
            'descripcion' => '',
        ];
    }
    public function quitarMes($indiceMes)
    {
        foreach ($this->pagos as $i => $pago) {
            if (isset($this->pagos[$i]['meses'][$indiceMes])) {
                unset($this->pagos[$i]['meses'][$indiceMes]);
                $this->pagos[$i]['meses'] = array_values($this->pagos[$i]['meses']);
            }
        }
    }
    public function quitarIngreso($indiceIngreso)
    {
        foreach ($this->ingresos as $i => $ingreso) {
            if (isset($this->ingresos[$indiceIngreso])) {
                unset($this->ingresos[$indiceIngreso]);
                $this->ingresos = array_values($this->ingresos);
            }
        }
    }
    public function asignarIngreso(){
        
        // Crear un nuevo ingreso
        $this->ingresoEditar->validate();
        $ingreso = $this->ingresoEditar->guardar();

        Pago::find($this->id)->ingresos()->attach($ingreso);
        $this->editar($this->id);
        $this->dispatch('success',['message'=>'Ingreso añadido con exito']);
    }
    public function asignarMensualidad(){
        
        $mensualidad = new Mensualidad([
            'mes'=> $this->mensualidadEditar['mes'],
            'anio'=> $this->mensualidadEditar['anio'] ,
            'porcentaje'=> $this->mensualidadEditar['porcentaje'],
            'exonerado'=> $this->mensualidadEditar['exonerado'],
        ]);
        
        Pago::find($this->id)->mensualidads()->save($mensualidad);

        $this->editar($this->id);
        $this->dispatch('success');
    }
    public function borrarIngreso($id)
    {
        $this->idBorrarIngreso = $id;
        $this->openEliminarIngreso = true;
    }
    public function borrarMensualidad($id){
        $this->idBorrarMensualidad = $id;
        $this->openEliminarMensualidad = true;
    }   
    public function eliminarIngreso(){
        Ingreso::find($this->idBorrarIngreso)->delete();
        $this->openEliminarIngreso = false;
        $this->editar($this->id);
        $this->dispatch('success');
    }   
    public function eliminarMensualidad(){
        Mensualidad::find($this->idBorrarMensualidad)->delete();
        $this->openEliminarMensualidad = false;
        $this->editar($this->id);
        $this->dispatch('success');
    }   
}		