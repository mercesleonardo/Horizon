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
        $baterias = Bateria::get();
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

            return response()->json("Bateria solicitada não existe", 404);
        }

        $ondas = Onda::with('notas', 'surfista')->where('bateria_id' , $bateria->id)->get();

        /**
         * Variável: $medias
         * Descrição: Esta variável é um array que será usado para armazenar as médias das notas para cada onda.
         */
        $medias = [];

        foreach($ondas as $onda) {

            foreach($onda->notas as $nota) {

                $notaFinal = ($nota->notaParcial1 + $nota->notaParcial2 + $nota->notaParcial3) / 3;
                array_push($medias, ['id'=>$nota->onda_id, 'nota'=>$notaFinal]);
            };

        };

        /**
         * Variável: $surfistaNotas
         * Descrição: Esta variável é um array que será usado para armazenar as notas médias de cada surfista.
         */
        $surfistaNotas = [];

        foreach ($medias as  $media) {

            $onda = Onda::with('surfista')->find($media['id']);

            if(!isset($surfistaNotas[$onda->surfista->nome])) {

                $surfistaNotas = array_merge($surfistaNotas, [$onda->surfista->nome=>[$media['nota']]]);

            } else {

                $surfistaNotas[$onda->surfista->nome] = array_merge($surfistaNotas[$onda->surfista->nome], [$media['nota']]);
            }

        }

        /**
         * Variável: $resultados
         * Descrição: Esta variável é um array que será usado para armazenar os resultados finais de cada surfista.
         */
        $resultados = [];

        foreach ($surfistaNotas as $key=>$surfista) {

            rsort($surfista);
            array_push($resultados, ['surfista'=>$key, 'nota'=>($surfista[0] + $surfista[1])]);
        }


        arsort($resultados);
        // dd($resultados);

        /**
         * Variáveis: $vencedor, $maiorNota
         * Descrição: Ao final deste trecho de código, a variável $vencedor será o surfista com a maior nota e a variável $maiorNota será a maior nota.
         */
        $vencedor = null;
        $maiorNota = 0;

        foreach ($resultados as $resultado) {

            if ($resultado['nota'] > $maiorNota) {

                $maiorNota = $resultado['nota'];
                $vencedor = $resultado['surfista'];
            }
        }

        $resposta = [
            'Bateria' => $bateria->id,
            'Resultados' => $resultados ?: "Aguarde o lançamento dos resultados",
            'Ganhador' => [
                'nome' => $vencedor ?: "Ainda não existe um vencedor",
                'pontuação' => $maiorNota ?: "Pontuação ainda não foi calculada"
            ]
        ];

        return response()->json($resposta, 200);
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
