@extends('layout')

@section('content')

@error('msg')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">Cadastrar Eleição</div>
        <div class="card-body">
          <form action="{{ route('salvar-eleicao') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="nome">Nome da Eleição:</label>
              <input type="text" id="nome" name="nome" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="orgao">Nome do Órgão:</label>
              <input type="text" id="orgao" name="orgao" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="data_inicio">Data de Início:</label>
              <input type="datetime-local" class="form-control" id="data_inicio" name="data_inicio" value="{{ old('data_inicio') }}" required>
            </div>
            <div class="form-group">
              <label for="data_fim">Data de Término:</label>
              <input type="datetime-local" class="form-control" id="data_fim" name="data_fim" value="{{ old('data_fim') }}" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  // Capturando elementos do DOM
  var dataInicioInput = document.getElementById("data_inicio");
  var dataFimInput = document.getElementById("data_fim");

  // Adicionando um ouvinte de evento para verificar quando a data de término é alterada
  dataFimInput.addEventListener("change", function () {
      var dataInicio = new Date(dataInicioInput.value);
      var dataFim = new Date(dataFimInput.value);

      // Verificando se a data de término é menor que a data de início
      if (dataFim < dataInicio) {
          alert("A data de término não pode ser menor que a data de início.");
          dataFimInput.value = ""; // Limpa o campo de data de término
      }
  });
</script>


@endsection
