<?php

namespace App\Http\Controllers;

use App\Eleicao;
use App\Eleitor;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class EleicaoController extends Controller
{
    public function cadastrar()
    {
        return view('cadastrar-eleicao');
    }

    public function salvar(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'orgao' => 'required',
            'chapas' => 'required|numeric',
            'eleitores' => 'required|mimes:xls,xlsx'

        ]);

        $eleicao = new Eleicao();
        $eleicao->nome = $request->nome;
        $eleicao->orgao = $request->orgao;
        $eleicao->user_id = auth()->id();
        $eleicao->save();

    }

    public function listarEleicoes()
    {
        $userId = auth()->id();
        $eleicoes = Eleicao::where('user_id', $userId)->get();
        return view('listar-eleicoes', ['eleicoes' => $eleicoes]);
    }

    public function editar($id)
    {
        $eleicao = Eleicao::where([
        ['id', $id],
        ['user_id', auth()->id()]])->first();
        return view('editar-eleicao', compact('eleicao'));
    }

    public function atualizar(Request $request, $id)
    {
        $eleicao = Eleicao::where([
        ['id', $id],
        ['user_id', auth()->id()]
        ])->first();
        $eleicao->update($request->all());
        return redirect()->route('listar-eleicoes');
    }

}
