<?php

namespace App\Http\Controllers;

use App\Models\Surfista;
use App\Http\Requests\StoreSurfistaRequest;
use App\Http\Requests\UpdateSurfistaRequest;

class SurfistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surfistas = Surfista::all();
        return $surfistas;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSurfistaRequest $request)
    {
        Surfista::create($request->all());
        return response()->json("Dados cadastrados com sucesso");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $surfista = Surfista::where('numero', $id)->first();
        return $surfista;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSurfistaRequest $request, $id)
    {

        $data = $request->all();
        Surfista::where('numero', $id)->update($data);
        return response()->json("Dados atualizados com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Surfista::where('numero', $id)->delete();
        return response()->json("Dados removidos com sucesso");
    }
}
