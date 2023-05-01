@extends('layout')

@section('content')
    <div class="container">
        <h1>Editar Eleição</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('editar-eleicao', ['id' => $eleicao->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome">Nome da Eleição</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $eleicao->nome) }}">
            </div>

            <div class="form-group">
                <label for="data_inicio">Data de Início</label>
                <input type="datetime-local" class="form-control" id="data_inicio" name="data_inicio" value="{{ old('data_inicio', $eleicao->data_inicio->format('Y-m-d\TH:i:s')) }}">
            </div>

            <div class="form-group">
                <label for="data_fim">Data de Término</label>
                <input type="datetime-local" class="form-control" id="data_fim" name="data_fim" value="{{ old('data_fim', $eleicao->data_fim->format('Y-m-d\TH:i:s')) }}">
            </div>

            <div class="form-group">
                <label for="eleitores">Importar Eleitores</label>
                <input type="file" class="form-control-file" id="eleitores" name="eleitores">
            </div>

            <hr>

            <h2>Chapas</h2>

            <div class="form-group">
                <label for="nome_chapa">Nome da Chapa</label>
                <input type="text" class="form-control" id="nome_chapa" name="nome_chapa">
            </div>

            <button type="button" class="btn btn-secondary" id="adicionar_chapa">Adicionar Chapa</button>

            <hr>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>

    <script>
        $(function() {
            var chapa_index = 0;

            $('#adicionar_chapa').click(function() {
                chapa_index++;

                var html = `
                    <div class="form-group">
                        <label for="votos_chapa_${chapa_index}">Votos para a Chapa "${$('#nome_chapa').val()}"</label>
                        <input type="number" class="form-control" id="votos_chapa_${chapa_index}" name="votos_chapa_${chapa_index}">
                    </div>
                `;

                $('#nome_chapa').val('');
                $('#adicionar_chapa').before(html);
            });
        });
    </script>

@endsection



