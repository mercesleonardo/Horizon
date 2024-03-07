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
        return response()->json($ondas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOndaRequest $request)
    {
        $data = Onda::create($request->all());
        return response()->json([
            'message' => 'Dados cadastrados com sucesso',
            'onda' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $onda = Onda::find($id);

        if (!$onda) {
            return response()->json("Recurso solicitado não existe", 404);
        }

        return response()->json($onda, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOndaRequest $request, $id)
    {
        $onda = Onda::find($id);

        if (!$onda) {
            return response()->json("Onda não encontrada", 404);
        }

        $data = $request->all();

        if (empty($data)) {
            return response()->json("Nenhum dado fornecido para atualização", 400);
        }

        $onda->update($data);

        return response()->json([
            'message' => 'Onda atualizada com sucesso',
            'onda' => $onda
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $onda = Onda::find($id);

        // dd($onda);

        if (!$onda) {
            return response()->json("Não foi possível excluir a onda, recurso não encontrado", 404);
        }

        $onda->delete();

        return response()->json("Dados removidos com sucesso");
    }
}
