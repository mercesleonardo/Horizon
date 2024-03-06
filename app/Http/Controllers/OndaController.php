<?php

namespace App\Http\Controllers;

use App\Models\Onda;
use App\Http\Requests\StoreOndaRequest;
use App\Http\Requests\UpdateOndaRequest;

class OndaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ondas = Onda::all();
        return $ondas;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOndaRequest $request)
    {
        $data = Onda::create($request->all());
        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(Onda $onda)
    {
        return $onda;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOndaRequest $request, Onda $onda)
    {
        $onda->update($request->all());
        return response()->json("Dados atualizados com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Onda $onda)
    {
        $onda->delete();
        return response()->json("Dados removidos com sucesso");
    }
}
