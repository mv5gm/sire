<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Estudiante;
use App\Models\Representante;
use Illuminate\Support\Facades\DB;

class AlumnoLive extends Component
{
    public $totalEstudiantes;
    public $totalRepresentantes;
    public $totalEstudiantesFemeninos;
    public $totalEstudiantesMasculinos;
    public $estudiantesPorNivel = [];
    public $estudiantesPorCategoria = [];
    public $representantesPorCategoria = [];

    public function mount(){

        $this->totalEstudiantes = Estudiante::count();
        $this->totalRepresentantes = Representante::count();
        $this->totalEstudiantesFemeninos = Estudiante::where('sexo','f')->count();
        $this->totalEstudiantesMasculinos = Estudiante::where('sexo','m')->count();
        $this->estudiantesPorNivel = $this->obtenerEstudiantesPorNivel();
        $this->estudiantesPorCategoria = $this->obtenerEstudiantesPorCategoria();
        $this->representantesPorCategoria = $this->obtenerRepresentantesPorCategoria();
    }   

    public function render()
    {
        return view('livewire.alumno-live');
    }
    public function obtenerEstudiantesPorNivel()
    {
        return DB::table('estudiantes')
            ->join('inscripcions', 'estudiantes.id', '=', 'inscripcions.estudiante_id')
            ->join('cursas', 'inscripcions.cursa_id', '=', 'cursas.id')
            ->join('nivels', 'cursas.nivel_id', '=', 'nivels.id')
            ->select('nivels.nombre as nivel', DB::raw('COUNT(estudiantes.id) as cantidad'))
            ->groupBy('nivels.nombre')
            ->orderBy('nivels.id', 'asc')
            ->get();
    }
    public function obtenerEstudiantesPorCategoria()
    {
        return DB::table('estudiantes')
            ->join('inscripcions', 'estudiantes.id', '=', 'inscripcions.estudiante_id')
            ->join('cursas', 'inscripcions.cursa_id', '=', 'cursas.id')
            ->join('nivels', 'cursas.nivel_id', '=', 'nivels.id')
            ->select('nivels.categoria as categoria', DB::raw('COUNT(estudiantes.id) as cantidad'))
            ->groupBy('nivels.categoria')
            ->orderBy('nivels.id', 'asc')
            ->get();
    }

    public function obtenerRepresentantesPorCategoria()
    {
        return DB::table('representantes')
        ->join('representados', 'representantes.id', '=', 'representados.representante_id')
        ->join('estudiantes', 'representados.estudiante_id', '=', 'estudiantes.id')
        ->join('inscripcions', 'estudiantes.id', '=', 'inscripcions.estudiante_id')
        ->join('cursas', 'inscripcions.cursa_id', '=', 'cursas.id')
        ->join('nivels', 'cursas.nivel_id', '=', 'nivels.id')
        ->select('nivels.categoria as categoria', DB::raw('COUNT(DISTINCT representantes.id) as cantidad'))
        ->groupBy('nivels.categoria')
        ->orderBy('nivels.id', 'asc')
        ->get();
    }

}
