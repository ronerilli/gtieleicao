@extends('layout')

@section('content')

        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top">
        <a class="navbar-brand" href="#">Sistema de Votação</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('listar-eleicoes') }}">Manter Eleições</a>
                </li>
                <li class>
        </nav>
        <div class="jumbotron">
            <h1 class="display-4">Bem-vindo ao sistema Grunti Eleição!</h1>
            <p class="lead">Aqui você pode acompanhar e participar das nossas eleições.</p>
            <hr class="my-4">
            <p>Clique no link Eleições para ver as eleições disponíveis.</p>
            <a class="btn btn-primary btn-lg" href="{{ route ('cadastrar-eleicao')}}" role="button">Criar nova eleição</a>
        </div>
@endsection
