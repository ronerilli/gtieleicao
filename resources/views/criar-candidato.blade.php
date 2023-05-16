@extends('layout')

@section('content')
    <div class="container">
        <h1>Cadastrar Candidato</h1>

        <form action="{{ route('candidatos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nome_completo">Nome Completo</label>
                <input type="text" name="nome_completo" id="nome_completo" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="biografia">Biografia</label>
                <textarea name="biografia" id="biografia" class="form-control" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control-file">
            </div>

            <div class="form-group">
                <label for="chapa_id">Chapa</label>
                <select name="chapa_id" id="chapa_id" class="form-control" required>
                    <!-- Exibir as opções de chapa aqui -->
                </select>
            </div>

            <div class="form-group">
                <label for="eleicao_id">Eleição</label>
                <select name="eleicao_id" id="eleicao_id" class="form-control" required>
                    <!-- Exibir as opções de eleição aqui -->
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
@endsection
