@extends('layout')

@section('content')

<div class="jumbotron jumbotron-fluid py-5">
    <div class="container">
        <h1 class="display-4">Bem-vindo ao sistema Grunti Eleição!</h1>
        <p class="lead">Aqui você pode acompanhar e participar das nossas eleições.</p>
        <hr class="my-4">
        @if (auth()->user()->profile == 'admin' || auth()->user()->profile == 'power')
            <p>Clique no link Eleições para ver as eleições disponíveis.</p>
            <a class="btn btn-primary btn-lg shadow-lg" href="{{ route('cadastrar-eleicao') }}" role="button">Criar nova eleição</a>
        @endif
        @if (auth()->user()->eleicao_id != null )
        <a class="btn btn-primary btn-lg shadow-lg" href="{{ route('exibir-eleicao', auth()->user()->eleicao_id) }}" role="button">Minha eleição</a>
        @endif
    </div>
</div>
@endsection
