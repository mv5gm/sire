<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Http\Requests\StoreGastoRequest;
use App\Http\Requests\UpdateGastoRequest;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('gastos');
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
    public function store(StoreGastoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Gasto $gasto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gasto $gasto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGastoRequest $request, Gasto $gasto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gasto $gasto)
    {
        //
    }
}
