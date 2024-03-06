<?php

namespace App\Http\Controllers;

use App\Models\Bateria;
use App\Http\Requests\StoreBateriaRequest;
use App\Http\Requests\UpdateBateriaRequest;

class BateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baterias = Bateria::all();
        return $baterias;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBateriaRequest $request)
    {
        $data = Bateria::create($request->all());
        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bateria = Bateria::where('id', $id)->first();

        return $bateria;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBateriaRequest $request, $id)
    {
        $data = $request->all();
        Bateria::where('id', $id)->update($data);
        return response()->json("Dados atualizado com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Bateria::where('id', $id)->delete();
        return response()->json("Dados removidos com sucesso");
    }
}
