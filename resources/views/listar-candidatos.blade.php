@extends('layout')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="container">
        <h1>Candidatos</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Nome Completo</th>
                    <th>Chapa</th>
                    <th>Eleição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($candidatos as $candidato)
                    <tr>
                        <td>{{ $candidato->nome_completo }}</td>
                        <td>{{ $candidato->chapa->nome }}</td>
                        <td>{{ $candidato->chapa->eleicao->nome }}</td>
                        <td>
                            <a href="{{ route('editar-candidato', $candidato->id) }}" class="btn btn-success" title="Editar">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('candidatos.destroy', $candidato->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="Deletar" onclick="return confirm('Tem certeza que deseja deletar este candidato?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mb-3">
            <a href="{{ route('candidatos.create') }}" class="btn btn-primary" title="Novo Candidato">
                Novo Candidato
            </a>
            <a href="{{ route('home') }}" class="btn btn-secondary" title="Voltar">
                Voltar
            </a>
        </div>
    </div>
@endsection
