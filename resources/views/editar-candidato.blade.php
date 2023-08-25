@extends('layout')

@section('content')
    <div class="container mt-5">
        <h1>Editar Candidato</h1>

        <form action="{{ route('candidatos.update', $candidato->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome_completo">Nome Completo</label>
                <input type="text" name="nome_completo" id="nome_completo" class="form-control" value="{{ $candidato->nome_completo }}" required>
            </div>

            <div class="form-group">
                <label for="biografia">Biografia</label>
                <textarea name="biografia" id="biografia" class="form-control" rows="5">{{ $candidato->biografia }}</textarea>
            </div>

            <div class="form-group d-flex flex-column">
                <label for="foto">Foto</label>
                <small>Selecione uma foto</small>
                <input type="file" name="foto" id="foto" class="form-control-file">
            </div>
            

            <div class="form-group">
                <label for="chapa_id">Chapa</label>
                <select name="chapa_id" id="chapa_id" class="form-control" required>
                    @if ($chapas)
                        @foreach ($chapas as $chapa)
                            <option value="{{ $chapa->id }}" {{ $chapa->id == $candidato->chapa_id ? 'selected' : '' }}>
                                {{ $chapa->nome }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="eleicao_id">Eleição</label>
                <select name="eleicao_id" id="eleicao_id" class="form-control" required>
                    @if ($eleicoes)
                        @foreach ($eleicoes as $eleicao)
                            <option value="{{ $eleicao->id }}" {{ $eleicao->id == $candidato->eleicao_id ? 'selected' : '' }}>
                                {{ $eleicao->nome }}
                            </option>
                        @endforeach
                    @endif    
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
@endsection
