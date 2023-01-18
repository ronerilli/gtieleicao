<?php

namespace App\Http\Controllers;

use App\Models\Eleicao;
use Illuminate\Http\Request;

class EleicaoController extends Controller
{
    public function cadastrar()
    {
        return view('cadastrar-eleicao');
    }

    public function salvar(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required',
            'orgao' => 'required',
        ]);

        $eleicao = new Eleicao();
        $eleicao->nome = $request->nome;
        $eleicao->orgao = $request->orgao;
        $eleicao->user_id = auth()->id();

        if($eleicao->save()) {
            return redirect()->route('home')->with('success', 'Eleição cadastrada com sucesso!');
        } else {
            return redirect()->route('cadastrar-eleicao')->withErrors(['msg'=>'Erro ao cadastrar eleição']);
        }
    }

    public function listarEleicoes()
{
    $userId = auth()->id();
    $eleicoes = Eleicao::where('user_id', $userId)->get();
    if ($eleicoes->count() == 0) {
        return view('listar-eleicoes', ['eleicoes' => [], 'vazio' => true]);
    } else {
        return view('listar-eleicoes', ['eleicoes' => $eleicoes, 'vazio' => false]);
    }
}


    public function editar($id)
    {
        $eleicao = Eleicao::where([
        ['id', $id],
        ['user_id', auth()->id()]])->first();
        return redirect()->route('editar-eleicao', ['id' => $id]);
    }

    public function atualizar(Request $request, $id)
    {
        dd($id);
        $eleicao = Eleicao::where([
        ['id', $id],
        ['user_id', auth()->id()]
        ])->first();
        $eleicao->update($request->all());
        return redirect()->route('editar-eleicao', ['id' => $id]);
    }

}
