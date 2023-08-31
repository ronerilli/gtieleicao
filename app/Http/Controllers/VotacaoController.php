<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Votacao;
use App\Models\User;
use App\Models\Eleicao;
use App\Services\VotouService;

class VotacaoController extends Controller
{
    protected $votouService;

    public function __construct(VotouService $votouService){
        $this->votouService = $votouService;
    }

    public function votar(Request $request)
    {   
        $eleicao = Eleicao::find($request->input("eleicao_id"));
        if ($eleicao->id != auth()->user()->eleicao_id) {
            return response()->json(
                array(
                'status' => 502,
                'message' => "Você não tem permissão para votar nesta eleição.")
            );
        }
        if (auth()->user()->votou == 1){
            return response()->json(
                array(
                'status' => 502,
                'message' => "Você já participou desta eleição.")
            );
        }
        else{
            $this->votouService->votou(auth()->user()->id);
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
}