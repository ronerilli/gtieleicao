@extends('layout')

@section('content')

<table class="table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Órgão</th>
            <th>Chapas</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eleicoes as $eleicao)
        <tr>
            <td>{{ $eleicao->nome }}</td>
            <td>{{ $eleicao->orgao }}</td>
            <td>{{ $eleicao->chapas }}</td>
            <td>
                <a href="{{ route('eleicoes.edit', $eleicao->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('eleicoes.destroy', $eleicao->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
