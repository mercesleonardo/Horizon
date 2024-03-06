<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Http\Requests\StoreNotaRequest;
use App\Http\Requests\UpdateNotaRequest;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notas = Nota::all();
        return $notas;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotaRequest $request)
    {
        Nota::create($request->all());
        return response()->json("Dados cadastrados com sucesso");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $nota = Nota::where('id', $id)->first();
        return $nota;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotaRequest $request, $id)
    {
        $data = $request->all();
        Nota::where('id', $id)->update($data);
        return response()->json("Dados atualizados com sucesso");
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Nota::where('id', $id)->delete();
        return response()->json("Dados removidos com sucesso");
    }
}
