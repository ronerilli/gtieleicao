<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Votacao;

class VotacaoController extends Controller
{
    public function votar(Request $request)
    {   
        $voto = new Votacao();
        $voto->eleicao_id = $request->input("eleicao_id");
        $voto->chapa_id = $request->input("chapa_id");
        $voto->created_at =  now();
        if($voto->save()) {
            return response()->json(
                array(
                'status' => 201,
                'message' => "Voto Computado com Sucesso")
            );
        } else {
            return response()->json(
                array(
                'status' => 502,
                'message' => "Houve um problema com o processamento do seu voto. Por favor, tente novamente")
            );
        }
            
    }
}