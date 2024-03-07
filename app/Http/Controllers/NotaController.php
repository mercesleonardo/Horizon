<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Onda;
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
        return response()->json($notas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotaRequest $request)
    {

        $data = Nota::create($request->all());

        return response()->json([
            'message' => 'Dados cadastrados com sucesso',
            'nota' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $nota = Nota::find($id);

        if (!$nota) {
            return response()->json("Recurso solicitado não existe", 404);
        }

        return response()->json($nota, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotaRequest $request, $id)
    {
        $nota = Nota::find($id);

        if (!$nota) {
            return response()->json("Nota não encontrada", 404);
        }

        $data = $request->all();

        if (empty($data)) {
            return response()->json("Nenhum dado fornecido para atualização", 400);
        }

        $nota->update($data);

        return response()->json([
            'message' => 'Nota atualizada com sucesso',
            'nota' => $nota
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $nota = Nota::find($id);

        if (!$nota) {
            return response()->json("Não foi possível excluir a nota, recurso não encontrado", 404);
        }

        $nota->delete();

        return response()->json("Dados removidos com sucesso");
    }
}
