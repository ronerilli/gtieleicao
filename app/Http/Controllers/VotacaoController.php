<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;

class VotacaoController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'eleicao_id' => 'required|integer',
            'chapa_id' => 'required|integer',
        ]);

        // Add the current timestamp to the data
        $data['created_at'] = now();

        // Save the vote to the database
        Vote::create($data);

        return response()->json(['message' => 'Voto registrado com sucesso.']);
    }
}
