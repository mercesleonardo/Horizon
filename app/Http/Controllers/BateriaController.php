<?php

namespace App\Http\Controllers;

use App\Models\Onda;
use App\Models\Bateria;
use App\Models\Surfista;
use App\Http\Requests\StoreBateriaRequest;
use App\Http\Requests\UpdateBateriaRequest;

class BateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baterias = Bateria::with('ondas')->get();
        return response()->json($baterias, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBateriaRequest $request)
    {
        $data = Bateria::create($request->all());
        return response()->json([
            'message' => 'Dados cadastrados com sucesso',
            'bateria' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bateria = Bateria::find($id);

        if (!$bateria) {
            return response()->json("Recurso solicitado não existe", 404);
        }

        // $ondas = Onda::with(['baterias', 'surfistas', 'notas'])->get()->map(function($item, $key) {

        //     $totalNotas = 0;
        //     $contadorNotas = 0;

        //     foreach ($item->notas as $nota) {

        //         $totalNotas += $nota->notaParcial1 + $nota->notaParcial2 + $nota->notaParcial3;
        //         $contadorNotas += 3;
        //     }

        //         $item->media = $contadorNotas > 0 ? $totalNotas / $contadorNotas : 0;

        //         return $item;
        // });

        $bateria->ondas()->with('notas', 'surfistas')->get();

        $bateria->ondas->each(function ($onda) {
            $nota = $onda->notas->first();
            if ($nota) {
                $onda->media = ($nota->notaParcial1 + $nota->notaParcial2 + $nota->notaParcial3) / 3;
            }
        });

        $media = $bateria->ondas->pluck('media')->toArray();

        return response()->json([
            'bateria' => $bateria,
            'Média' => $media,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBateriaRequest $request, $id)
    {
        $bateria = Bateria::find($id);

        if (!$bateria) {
            return response()->json("Bateria não encontrada", 404);
        }

        $data = $request->all();

        if (empty($data)) {
            return response()->json("Nenhum dado fornecido para atualização", 400);
        }

        $bateria->update($data);

        return response()->json([
            'message' => 'Bateria atualizada com sucesso',
            'bateria' => $bateria
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bateria = Bateria::find($id);

        if (!$bateria) {
            return response()->json("Não foi possível excluir a bateria, recurso não encontrado", 404);
        }

        $bateria->delete();

        return response()->json("Dados removidos com sucesso");
    }
}
