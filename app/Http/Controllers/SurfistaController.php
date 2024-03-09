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
        return response()->json($surfistas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSurfistaRequest $request)
    {
        $data = Surfista::create($request->all());
        return response()->json([
            'message' => 'Dados cadastradas com sucesso',
            'surfista' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $surfista = Surfista::find($id);

        if (!$surfista) {

            return response()->json("Surfista solicitado não existe", 404);

        }

        return response()->json($surfista, 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSurfistaRequest $request, $id)
    {

        $surfista = Surfista::find($id);

        if (!$surfista) {
            return response()->json("Surfista não encontrado", 404);
        }

        $data = $request->all();

        if (empty($data)) {
            return response()->json("Nenhum dado fornecido para atualização", 400);
        }

        $surfista->update($data);

        return response()->json([
            'message' => 'Surfista atualizado com sucesso',
            'surfista' => $surfista
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $surfista = Surfista::find($id);

        if (!$surfista) {
            return response()->json("Não foi possível excluir o surfista, recurso não encontrado", 404);
        }

        $surfista->delete();
        return response()->json("Dados removidos com sucesso");
    }
}
