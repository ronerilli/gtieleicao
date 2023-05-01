<?php

namespace App\Http\Controllers;

use App\Models\Eleicao;
use App\Models\Eleitor;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;


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
            'data_inicio' => 'required',
            'data_fim' => 'required',
        ]);

        $eleicao = new Eleicao();
        $eleicao->nome = $request->nome;
        $eleicao->orgao = $request->orgao;
        $eleicao->data_inicio = $request->data_inicio;
        $eleicao->data_fim = $request->data_fim;
        $eleicao->user_id = auth()->id();

        $chapas_data = $request->only('nome_chapa', ); // lista dos campos das chapas (votos_chapa_1, votos_chapa_2, ...)
        $chapas = [];

    foreach ($chapas_data as $chapa_nome => $votos) {
        if (!empty($votos)) {
            $chapa = new Chapa();
            $chapa->nome = $chapa_nome;
            $chapa->votos = $votos;
            $chapa->eleicao_id = $id;
            $chapa->save();
            $chapas[] = $chapa;
        }
    }


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
            return view('listar-eleicoes', ['eleicoes' => $eleicoes, 'vazio' => false, 'id' => $userId]);
        }
    }


    public function editar($id)
    {

        $eleicao = Eleicao::where([
        ['id', $id],
        ['user_id', auth()->id()]])->first();

        //return view('editar-eleicao', ['id' => $id]);
        return view('editar-eleicao', ['eleicao' => $eleicao]);
    }



    public function atualizar(Request $request, $id)
    {
        $eleicao = Eleicao::where([
        ['id', $id],
        ['user_id', auth()->id()]
        ])->first();
        $eleicao->update($request->all());

        // Verifica se foi enviado um arquivo
        if ($request->hasFile('eleitores')) {
            $spreadsheet = IOFactory::load($request->file('eleitores'));
            $worksheet = $spreadsheet->getActiveSheet();

            // Itera sobre as linhas da planilha
            foreach ($worksheet->getRowIterator() as $row) {
                $rowIndex = $row->getRowIndex();
                // Pula a primeira linha (cabeçalho)
                if ($rowIndex > 1) {
                    $nome = $worksheet->getCellByColumnAndRow(1, $rowIndex)->getValue();
                    $matricula = $worksheet->getCellByColumnAndRow(2, $rowIndex)->getValue();
                    $telefone = $worksheet->getCellByColumnAndRow(3, $rowIndex)->getValue();

                    Eleitor::create([
                    'nome' => $nome,
                    'matricula' => $matricula,
                    'telefone' => $telefone,
                    'eleicao_id' => $id,
                    ]);
                }
            }
        }

    return redirect()->route('listar-eleicoes', ['id'=> $id]);
    }


    public function excluir($id)
    {
        $eleicao = Eleicao::find($id);
        $eleicao->delete();
        return redirect()->route('listar-eleicoes')->with('success', 'Eleição excluída com sucesso.');
    }


}
