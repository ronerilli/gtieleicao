@extends('layout')

@section('content')

@error('msg')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<!-- arquivo: resources/views/cadastrar-eleicao.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Eleição</title>
</head>
<body>
    <h1>Cadastrar Eleição</h1>
    <form action="{{ route('salvar-eleicao') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="nome">Nome da Eleição:</label>
        <input type="text" id="nome" name="nome" required><br>
        <label for="orgao">Nome do Órgão:</label>
        <input type="text" id="orgao" name="orgao" required><br>
        {{-- <label for="chapas">Quantidade de Chapas:</label>
        <input type="number" id="chapas" name="chapas" required><br> --}}
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
@endsection
