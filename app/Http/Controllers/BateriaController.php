<?php

namespace App\Http\Controllers;

use App\Models\Onda;
use App\Models\Nota;
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

    function obterSomaDuasMaioresNotas($notas) {
        // Ordenar as notas em ordem decrescente
        usort($notas, function($a, $b) {
          return $b->nota - $a->nota;
        });

        // Retornar a soma das duas maiores notas
        return $notas[0]->nota + $notas[1]->nota;
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

        $ondas = Onda::with('notas', 'surfista')->where('bateria_id' , $bateria->id)->get();

        $somaOndas = [];

        foreach($ondas as $onda) {

            foreach($onda->notas as $nota) {

                $notaFinal = ($nota->notaParcial1 + $nota->notaParcial2 + $nota->notaParcial3) / 3;
                array_push($somaOndas, ['id'=>$nota->onda_id, 'nota'=>$notaFinal]);
            };

        };

        $surfistaNotas = [];

        foreach ($somaOndas as  $soma) {

            $onda = Onda::with('surfista')->find($soma['id']);

            if(!isset($surfistaNotas[$onda->surfista->nome])) {

                $surfistaNotas = array_merge($surfistaNotas, [$onda->surfista->nome=>[$soma['nota']]]);

            } else {
                
                $surfistaNotas[$onda->surfista->nome] = array_merge($surfistaNotas[$onda->surfista->nome], [$soma['nota']]);
            }

        }

        $resultados = [];

        foreach ($surfistaNotas as $key=>$surfista) {

            rsort($surfista);
            array_push($resultados, ['surfista'=>$key, 'nota'=>($surfista[0] + $surfista[1])]);
        }

        arsort($resultados);

        $vencedor = null;
        $maiorNota = 0;

        foreach ($resultados as $resultado) {

            if ($resultado['nota'] > $maiorNota) {

                $maiorNota = $resultado['nota'];
                $vencedor = $resultado['surfista'];
            }
        }

        return response()->json([
            'Ganhador' => $vencedor,
            'Pontuação total da bateria' => $maiorNota,
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
