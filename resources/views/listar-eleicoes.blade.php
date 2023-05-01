@extends('layout')

@section('content')

<table class="table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Órgão</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eleicoes as $eleicao)
        <tr>
            <td>{{ $eleicao->nome }}</td>
            <td>{{ $eleicao->orgao }}</td>
            <td>
                <a href="{{ route('editar-eleicao', $eleicao->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('excluir-eleicao', $eleicao->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('home') }}" class="btn btn-primary">Voltar para Home</a>
@endsection