<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidatos = Candidato::all();

        return view('listar-candidatos', compact('candidatos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retorne a view com o formulário para criar um novo candidato
        return view('criar-candidato');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valide os dados do formulário
        $validatedData = $request->validate([
            'nome_completo' => 'required',
            'biografia' => 'nullable',
            'foto' => 'nullable|image',
            'chapa_id' => 'required|exists:chapas,id',
            'eleicao_id' => 'required|exists:eleicoes,id',
        ]);

        // Salve os dados do candidato
        $candidato = Candidato::create($validatedData);

        // Faça o upload da foto, se presente
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('candidato_fotos');
            $candidato->foto = $fotoPath;
            $candidato->save();
        }

        // Redirecione para a página de exibição do candidato criado
        return view('listar-candidatos', compact('candidatos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function show(Candidato $candidato)
    {
        return view('exibir-candidato', compact('candidato'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidato $candidato)
    {
        return view('editar-candidato', compact('candidato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidato  $candidato
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
        return view('listar-candidatos', compact('candidatos'));
    }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\Candidato  $candidato
         * @return \Illuminate\Http\Response
         */
    public function destroy(Candidato $candidato)
    {
            // Exclua o candidato do banco de dados
            $candidato->delete();

            // Redirecione de volta para a página de listagem de candidatos
        return view('listar-candidatos', compact('candidatos'));
    }
}               