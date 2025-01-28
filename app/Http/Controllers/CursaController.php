<?php

namespace App\Http\Controllers;

use App\Models\Cursa;
use App\Http\Requests\StoreCursaRequest;
use App\Http\Requests\UpdateCursaRequest;

class CursaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cursas');
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
    public function store(StoreCursaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cursa $cursa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cursa $cursa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCursaRequest $request, Cursa $cursa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cursa $cursa)
    {
        //
    }
}
