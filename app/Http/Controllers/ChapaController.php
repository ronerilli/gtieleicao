<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapa;

class ChapaController extends Controller
{
    public function create($eleicao_id)
    {
        return view('chapas.create', ['eleicao_id' => $eleicao_id]);
    }

    public function store(Request $request, $eleicao_id)
    {
        $validatedData = $request->validate([
            'nome' => 'required',
            'votos' => 'required|integer|min:0',
        ]);

        $chapa = new Chapa();
        $chapa->nome = $validatedData['nome'];
        $chapa->votos = $validatedData['votos'];
        $chapa->eleicao_id = $eleicao_id;
        $chapa->save();

        return redirect()->route('listar-chapas', ['id' => $eleicao_id])
                         ->with('success', 'Chapa criada com sucesso.');
    }

    public function index($eleicao_id)
    {
        $chapas = Chapa::where('eleicao_id', $eleicao_id)->get();
        return view('chapas.index', ['chapas' => $chapas, 'eleicao_id' => $eleicao_id]);
    }
}
