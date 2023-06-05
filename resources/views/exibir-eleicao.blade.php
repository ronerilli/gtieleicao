@extends('layouts.app')

@section('content')
    <h1>Eleição: {{ $eleicao->nome }}</h1>

    <h2>Chapas:</h2>
    <ul>
        @foreach ($chapas as $chapa)
            <li>
                <h3>{{ $chapa->nome }}</h3>
                <p>{{ $chapa->descricao }}</p>
                <img src="{{ $chapa->foto }}" alt="Foto do candidato">
                <form method="POST" action="{{ route('votar-eleicao', ['id' => $eleicao->id]) }}">
                    @csrf
                    <input type="hidden" name="chapa" value="{{ $chapa->id }}">
                    <button type="submit">Votar nesta chapa</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
