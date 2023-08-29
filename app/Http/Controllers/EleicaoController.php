<?php

namespace App\Http\Controllers;

use App\Models\Eleicao;
use App\Models\Eleitor;
use App\Models\Chapa;
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

        

    if($eleicao->save()) {
        return redirect()->route('listar-eleicoes')->with('success', 'Eleição criada com sucesso.');
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
            ['user_id', auth()->id()]
        ])->firstOrFail();
        
        $chapas = $eleicao->chapas()->get();

        return view('editar-eleicao', compact('eleicao', 'chapas'));
    }



    public function atualizar(Request $request, $id)
    {
        $eleicao = Eleicao::where([
            ['id', $id],
            ['user_id', auth()->id()]
        ])->firstOrFail();
        
        $eleicao->nome = $request->filled('nome') ? $request->input('nome') : $eleicao->nome;
        $eleicao->orgao = $request->filled('orgao') ? $request->input('orgao') : $eleicao->orgao;
        $eleicao->data_inicio = $request->filled('data_inicio') ? $request->input('data_inicio') : $eleicao->data_inicio;
        $eleicao->data_fim = $request->filled('data_fim') ? $request->input('data_fim') : $eleicao->data_fim;
        
        $eleicao->save();

           
        //Acrescenta chapas cadastradas
        $chapas = [];

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'nome_chapa_') === 0) {
                $chapa_count = str_replace('nome_chapa_', '', $key);
                $chapas[] = [
                    'nome' => $value,
                    'votos' => 0,
                    'eleicao_id' => $eleicao->id // adiciona o ID da eleição
                ];
            }
        }
        
        foreach ($chapas as $chapa) {
            if (!empty($chapa['nome'])) {
                $chapa_entity = Chapa::where([
                    ['nome', $chapa['nome']],
                    ['eleicao_id', $eleicao->id],
                ])->first();
        
                if ($chapa_entity) {
                    $chapa_entity->nome = $chapa['nome'];
                    $chapa_entity->save();
                } else {
                    Chapa::create([
                        'nome' => $chapa['nome'],
                        'votos' => 0,
                        'eleicao_id' => $eleicao->id,
                    ]);
                }
            }
        }
        
        

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
    return redirect()->route('listar-eleicoes', ['id'=> $id])->with('success', 'Dados atualizados com sucesso.');
  
    }


    public function excluir($id)
    {
        $eleicao = Eleicao::find($id);

        // Excluir todas as chapas relacionadas
        foreach ($eleicao->chapas as $chapa) {
            // Excluir todos os candidatos relacionados à chapa
            foreach ($chapa->candidatos as $candidato) {
                $candidato->delete();
            }
            
            $chapa->delete();
        }

        // Excluir a eleição
        $eleicao->delete();

        return redirect()->route('listar-eleicoes')->with('success', 'Eleição excluída com sucesso.');
    }

    public function votar($id)
    {
        $eleicao = Eleicao::find($id);
        
        // Verifica se o usuário pertence à eleição
        if ($eleicao->user_id != auth()->id()) {
            return redirect()->route('listar-eleicoes')->withErrors(['msg' => 'Você não tem permissão para votar nesta eleição.']);
        }
        
        // Verifica se o usuário já votou
        $eleitor = Eleitor::where('eleicao_id', $id)
            ->where('matricula', auth()->user()->matricula)
            ->first();
        
        if ($eleitor->votou) {
            return redirect()->route('listar-eleicoes')->withErrors(['msg' => 'Você já votou nesta eleição.']);
        }
        
        // Obtém as chapas da eleição
        $chapas = $eleicao->chapas;
        
        return view('registrar-voto', compact('chapas'));
    }
    
    public function registrarVoto(Request $request, $id)
    {
        $eleicao = Eleicao::find($id);
        
        // Verifica se o usuário pertence à eleição
        if ($eleicao->user_id != auth()->id()) {
            return redirect()->route('listar-eleicoes')->withErrors(['msg' => 'Você não tem permissão para votar nesta eleição.']);
        }
        
        // Verifica se o usuário já votou
        $eleitor = Eleitor::where('eleicao_id', $id)
            ->where('matricula', auth()->user()->matricula)
            ->first();
        
        if ($eleitor->votou) {
            return redirect()->route('listar-eleicoes')->withErrors(['msg' => 'Você já votou nesta eleição.']);
        }
        
        // Obtém a chapa selecionada
        $chapaId = $request->input('chapa');
        $chapa = Chapa::find($chapaId);
        
        if (!$chapa) {
            return redirect()->back()->withErrors(['msg' => 'Chapa inválida.']);
        }
        
        // Atualiza os votos da chapa
        $chapa->votos += 1;
        $chapa->save();
        
        // Atualiza o registro do eleitor informando que ele votou
        $eleitor->votou = true;
        $eleitor->save();
        
        return redirect()->route('listar-eleicoes')->with('success', 'Voto registrado com sucesso.');
    }
    
    public function exibirEleicao($id)
    {
        $eleicao = Eleicao::findOrFail($id);
        $chapas = $eleicao->chapas;

        return view('exibir-eleicao', compact('eleicao', 'chapas'));
    }

    public function votarEleicao(Request $request, $id)
    {
        $eleicao = Eleicao::findOrFail($id);
        $chapaId = $request->input('chapa');

        // Atualize os votos da chapa selecionada
        $chapa = Chapa::findOrFail($chapaId);
        $chapa->votos += 1;
        $chapa->save();

        // Marque o eleitor como tendo votado
        $eleitor = Eleitor::where('eleicao_id', $id)
            ->where('matricula', auth()->user()->matricula)
            ->first();
        $eleitor->votou = true;
        $eleitor->save();

        return redirect()->route('listar-eleicoes')->with('success', 'Voto registrado com sucesso.');
    }

}
