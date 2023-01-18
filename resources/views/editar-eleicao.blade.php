@extends('layout')

@section('content')

<!-- arquivo: resources/views/editar-eleicao.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Editar Eleição</title>
</head>
<body>
    <h1>Editar Eleição</h1>
    <form action="{{ route('atualizar-eleicao', $eleicao->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="nome">Nome da Eleição:</label>
        <input type="text" id="nome" name="nome" value="{{ $eleicao->nome }}" required><br>
        <label for="orgao">Nome do Órgão:</label>
        <input type="text" id="orgao" name="orgao" value="{{ $eleicao->orgao }}" required><br>
        {{-- <label for="chapas">Quantidade de Chapas:</label>
        <input type="number" id="chapas" name="chapas" value="{{ $eleicao->chapas }}" required><br> --}}
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>

@endsection
