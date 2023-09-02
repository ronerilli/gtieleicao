@extends('layout')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">Resultados Eleição {{ $eleicao->nome }}</div>
        <div class="card-body">
          <ul>
            @foreach ($votos as $voto)
              <li>Chapa ID: {{ $voto->chapa_id }}, Count: {{ $voto->Votos }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
