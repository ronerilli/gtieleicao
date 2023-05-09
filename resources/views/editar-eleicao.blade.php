@extends('layout')

@section('content')
    <div class="container">
        <h1>Editar Eleição</h1>

        <form action="{{ route('atualizar-eleicao', ['id' => $eleicao->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome">Nome da Eleição</label>
                <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome', $eleicao->nome) }}">
                @error('nome')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="data_inicio">Data de Início</label>
                <input type="datetime-local" class="form-control @error('data_inicio') is-invalid @enderror" id="data_inicio" name="data_inicio" value="{{ old('data_inicio', $eleicao->data_inicio->format('Y-m-d\TH:i:s')) }}">
                @error('data_inicio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="data_fim">Data de Término</label>
                <input type="datetime-local" class="form-control @error('data_fim') is-invalid @enderror" id="data_fim" name="data_fim" value="{{ old('data_fim', $eleicao->data_fim->format('Y-m-d\TH:i:s')) }}">
                @error('data_fim')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="eleitores">Importar Eleitores</label>
                <input type="file" class="form-control-file @error('eleitores') is-invalid @enderror" id="eleitores" name="eleitores">
                @error('eleitores')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>

            <h2>Chapas</h2>

            <div id="chapas_container">
            @foreach ($chapas as $chapa_count => $chapa_nome)
                <div class="form-group">
                    <label for="nome_chapa_{{ $chapa_count }}">Nome da Chapa {{ $chapa_count + 1 }}</label>
                    <input type="text" class="form-control" id="nome_chapa_{{ $chapa_count }}" name="nome_chapa_{{ $chapa_count }}" value="{{ old('nome_chapa_' . $chapa_count, $chapa_nome) }}" data-chapa-count="{{ $chapa_count }}">
                </div>
             @endforeach
            </div>


            <button type="button" class="btn btn-secondary" id="adicionar_chapa">Adicionar
            <hr>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('listar-eleicoes') }}" class="btn btn-secondary">Cancelar</a>
        </form>
        </div>

        
        <script>
            $(function() {
                 var chapa_count = $('input[name^="nome_chapa_"]').length;

                 $('#adicionar_chapa').click(function() {
                    chapa_count++;

                    var html = '<div class="form-group">';
                    html += '<label for="nome_chapa_' + chapa_count + '">Nome da Chapa ' + (chapa_count + 1) + '</label>';
                    html += '<input type="text" class="form-control" id="nome_chapa_' + chapa_count + '" name="nome_chapa_' + chapa_count + '" value="">';
                    html += '</div>';

                $('#chapas_container').append(html);
                });
            });
        </script>   

@endsection