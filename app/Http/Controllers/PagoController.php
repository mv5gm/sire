<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Aescolar;
use App\Models\Representante;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use App\Models\Cursa;
use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pagos');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePagoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePagoRequest $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        //
    }

    public function reporte($estudiante_id,$representante_id,$aescolar,$tipo){ 

        $pagos = Pago::where('representante_id',$representante_id)->where('estudiante_id',$estudiante_id)->where('aescolar_id',$aescolar)->where('tipo',$tipo)->orderBy('fecha','asc')->get();

        $aescolar = Aescolar::find($aescolar)->first();

        $estudiante = Inscripcion::where('estudiante_id',$estudiante_id)->with('cursa.seccion','cursa.nivel')->first();

        $representante = Representante::find($representante_id);

        //dd($estudiante_id);

        return view('reportes.pagos',compact("estudiante","pagos","representante","aescolar"));
    }   
}       