<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Votacao;
use App\Models\Chapa;
use App\Models\Eleicao;

class VotacaoController extends Controller
{
    public function votar(Request $request)
    {
        $data = $request->validate([
            'eleicao_id' => 'required|integer',
            'chapa_id' => 'required|integer',
        ]);

        $voto = new Votacao();
        $voto->eleicao_id = $request->eleicao_id;
        $voto->chapa_id = $request->chapa_id;
        $voto->created_at =  now();

        if($voto->save()) {
            return response()->json(['message' => 'Voto registrado com sucesso.']);
            } else {
                return response()->json(['message' => 'Houve um problema no registro do voto.']);
            }
        }

    }
}
