<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chapa;
use App\Models\Eleicao;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->profile != "admin" && auth()->user()->profile != "power"){
            return redirect()->intended('/home');
        }
        $candidatos = Candidato::with('chapa', 'eleicao')
            ->where('eleicao_id', auth()->user()->eleicao_id)
            ->get();
        return view('listar-candidatos', compact('candidatos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // Obtenha o ID do usuário atualmente autenticado
    $userId = Auth::id();

    // Consulte as chapas relacionadas ao usuário atual
    $chapas = Chapa::whereHas('eleicao', function ($query) use ($userId) {
        $query->where('user_id', $userId);
    })->get();

    // Obtenha as eleições relacionadas às chapas encontradas
    $eleicoes = Eleicao::whereIn('id', $chapas->pluck('eleicao_id'))->get();

    // Retorne a view com as chapas e eleições encontradas
    return view('criar-candidato', compact('chapas', 'eleicoes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar os dados do formulário
        $validatedData = $request->validate([
            'nome_completo' => 'required',
            'biografia' => 'nullable',
            'foto' => 'nullable|image',
            'chapa_id' => 'required|exists:chapas,id',
            'eleicao_id' => 'required|exists:eleicoes,id',
        ]);

        // Salva os dados do candidato
        $candidatos = Candidato::create($validatedData);

        // Fazer o upload da foto, se presente
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('candidato_fotos');
            $candidatos->foto = $fotoPath;
            $candidatos->save();
        }

         // Redirecione para a página de listagem de candidatos
         return redirect()->route('listar-candidatos')->with('success', 'Candidato salvo com sucesso!');
    }

    /**
     * Mostra o candidato especificado
     *
     * @param  \App\Models\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function show(Candidato $candidatos)
    {
        return view('exibir-candidato');
    }

    /**
     * Mostra o formulário de exibição
     *
     * @param  \App\Models\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Recupere o candidato com base no ID
        $candidato = Candidato::find($id);

        // Recupere todas as chapas disponíveis
        $chapas = Chapa::all();

        // Recupere todas as eleições disponíveis
        $eleicoes = Eleicao::all();

        // Verifique se o candidato existe
        if (!$candidato) {
            // Retorne uma resposta adequada, como redirecionar para a página de listagem de candidatos ou exibir uma mensagem de erro.
        }

        // Retorne a view de edição do candidato com os dados necessários
        return view('editar-candidato', compact('candidato', 'chapas', 'eleicoes'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidato  $candidatos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidato $candidato)
    {
        // Valide os dados do formulário
        $validatedData = $request->validate([
            'nome_completo' => 'required',
            'biografia' => 'nullable',
            'foto' => 'nullable|image',
            'chapa_id' => 'required|exists:chapas,id',
            'eleicao_id' => 'required|exists:eleicoes,id',
        ]);

        // Atualize os dados do candidato
        $candidato->update($validatedData);

        // Faça o upload da foto, se presente
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('candidato_fotos');
            $candidato->foto = $fotoPath;
            $candidato->save();
        }

        // Redirecione para a página de exibição do candidato atualizado
        return redirect()->route('listar-candidatos')->with('success', 'Candidato alterado com sucesso!');
    }


    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Candidato  $candidatos
    * @return \Illuminate\Http\Response
    */
    public function destroy(Candidato $candidato)
    {
        // Exclua o candidato do banco de dados
        $candidato->delete();

        // Redirecione de volta para a página de listagem de candidatos com a mensagem
        return redirect()->route('listar-candidatos')->with('success', 'Candidato deletado com sucesso!');
    }
        
}               