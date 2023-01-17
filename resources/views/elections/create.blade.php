@extends('layout')

@section('content')

<form method="POST" action="{{ route('elections.store') }}">
    @csrf

    <div class="form-group">
        <label for="name">Nome da Eleição</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="form-group">
        <label for="organization_name">Nome do Orgão</label>
        <input type="text" class="form-control" id="organization_name" name="organization_name" required>
    </div>

    <div class="form-group">
        <label for="num_chapters">Quantidade de Chapas</label>
        <input type="number" class="form-control" id="num_chapters" name="num_chapters" required>
    </div>

    <div class="form-group">
        <label for="num_candidates">Quantidade de Candidatos</label>
        <input type="number" class="form-control" id="num_candidates" name="num_candidates" required>
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
@endsection
