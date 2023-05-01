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
        <input type="submit" value="Cadastrar">
        <div class="form-group">
        <label for="data_hora_inicio">Data de Início</label>
            <input type="datetime-local" class="form-control" id="data_hora_inicio" name="data_hora_inicio" value="{{ old('data_hora_inicio', $eleicao->data_hora_inicio->format('Y-m-d\TH:i:s')) }}">
        </div>
        <div class="form-group">
        <label for="data_hora_fim">Data de Término</label>
        <input type="datetime-local" class="form-control" id="data_hora_fim" name="data_hora_fim" value="{{ old('data_hora_fim', $eleicao->data_hora_fim->format('Y-m-d\TH:i:s')) }}">
        </div>
    </form>
</body>
</html>
@endsection
