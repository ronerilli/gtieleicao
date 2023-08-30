<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            return redirect()->back()->with(['message', 'Voto registrado com sucesso.']);
        } else {
            return redirect()->back()->with(['erro', 'Problema com Voto.']);
        }
            
    }
}