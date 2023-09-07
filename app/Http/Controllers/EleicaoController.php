<?php

namespace App\Http\Controllers;

use App\Models\Eleicao;
use App\Models\Votacao;
use App\Models\User;
use App\Models\Chapa;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class EleicaoController extends Controller
{

    public function cadastrar()
    {
        if (auth()->user()->profile != "admin" && auth()->user()->profile != "power"){
            return redirect()->intended('/home');
        }
        return view('cadastrar-eleicao');
    }

    public function salvar(Request $request)
    {
        if (auth()->user()->profile != "admin" && auth()->user()->profile != "power"){
            return redirect()->intended('/home');
        }
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
        if (auth()->user()->profile != "admin" && auth()->user()->profile != "power"){
            return redirect()->intended('/home');
        }
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
        if (auth()->user()->profile != "admin" && auth()->user()->profile != "power"){
            return redirect()->intended('/home');
        }
        $eleicao = Eleicao::where([
            ['id', $id],
            ['user_id', auth()->id()]
        ])->firstOrFail();
        
        $chapas = $eleicao->chapas()->get();

        return view('editar-eleicao', compact('eleicao', 'chapas'));
    }



    public function atualizar(Request $request, $id)
    {
        if (auth()->user()->profile != "admin" && auth()->user()->profile != "power"){
            return redirect()->intended('/home');
        }
        
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

                    if (strpos("+", $telefone) == false){
                        $telefone = "+55" . $telefone;
                    }

                    if(User::where('name', $nome)->where('matricula', $matricula)->count() == 0){

                        User::create([
                            'name' => $nome,
                            'matricula' => $matricula,
                            'telefone' => $telefone,
                            'eleicao_id' => $id,
                            'password' => Hash::make(Str::random(21)),
                            'profile' => 'User',
                            'votou' => 0
                        ]);
                    }
                    
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
    
    public function exibirEleicao($id)
    {
        $eleicao = Eleicao::findOrFail($id);
        $currentDateTime = Carbon::now();
        $specificTime = Carbon::parse($eleicao->data_fim);

        if ($currentDateTime->greaterThan($specificTime)) {
            return redirect()->route('resultados-eleicao', $eleicao->id);
        }
        
        $chapas = $eleicao->chapas()->get();
        $candidatos = $eleicao->candidatos;

        return view('exibir-eleicao', compact('eleicao', 'chapas', 'candidatos'));
    }

    public function resultadosEleicao($id){
        $results = DB::table('votacaos')
            ->select('chapas.nome', 'chapas.id',DB::raw('COUNT(*) as count'))
            ->join('chapas', 'votacaos.chapa_id', '=', 'chapas.id')
            ->join('eleicoes', 'eleicoes.id', '=', DB::raw($id))
            ->where('votacaos.eleicao_id', $id)
            ->groupBy('votacaos.chapa_id')
            ->get();
        
        $chapaIdWithMaxCount = $results->where('count', $results->max('count'))->pluck('id')->first();
        $eleicao = Eleicao::findOrFail($id);
        $chapas = $eleicao->chapas()->get()->where('id', $chapaIdWithMaxCount);
        $candidatos = $eleicao->candidatos->where('chapa_id', $chapaIdWithMaxCount);
        
        return view('resultados-eleicao', compact('results', 'eleicao', 'chapas', 'candidatos'));
    }

}
