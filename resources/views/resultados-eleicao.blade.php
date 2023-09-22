@extends('layout')

@section('content')
<script src="{{ asset('js/eleicoes.js') }}"></script>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
          <h1 class="text-body-secondary text-md text-sm text-center">Resultados Eleições {{ $eleicao->nome }}</h1>
          <br>
          <div class="embed-responsive">
            <canvas id="electionChart"></canvas>
          </div>
          <br>
          <br>
          <h1 class="text-body-secondary text-md text-sm text-center">Chapa Vencedora</h1>
          @foreach ($chapas as $chapa)
            <div class="col-12 col-md-4" style="width: 100%">
                <div class="slate-name text-body-secondary text-md text-sm">{{ $chapa->nome }}</div>
                    <div class="row">
                        @foreach ($candidatos as $candidato)
                            @if ($candidato->chapa_id == $chapa->id)
                                  <div class="col-3">
                                    <div class="candidate-card card">
                                        <br>
                                        <div class="candidate-photo">
                                            <img src="{{ Storage::disk('s3')->url($candidato->foto) }}" alt="Candidate 4" class="card-img-top">
                                        </div>
                                        <div class="candidate-name"><h5>{{ $candidato->nome_completo }}<h5></div>
                                        <br>
                                        <button class="btn btn-warning btn-sm toggle-bio" data-bs-toggle="collapse" href="#candidato-{{ $candidato->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Mostrar Biografia
                                        </button>
                                    </div>
                                    <div class="collapse overflow-y-auto" id="candidato-{{ $candidato->id }}">
                                        <div class="card card-body bio">
                                            {{ $candidato->biografia }}
                                        </div>
                                        <!-- <a class="btn btn-light btn-sm more" href="#">Mostrar tudo</a> -->
                                    </div>
                                  </div>
                            @endif
                        @endforeach
                    </div>
                    <form style="border: none;" method="POST" id="form-{{ $chapa->id }}" action="{{ route('votar-eleicao', ['id' => $eleicao->id]) }}">
                        @csrf
                        <input type="hidden" name="chapa_id" value="{{ $chapa->id }}">
                        <input type="hidden" name="eleicao_id" value="{{ $eleicao->id }}">
                    </form>
                </div>
            @endforeach
  </div>
</div>
<script>
  var ctx = document.getElementById('electionChart').getContext('2d');
  var results = @json($results);
  function randomRGBA() {
    var r = Math.floor(Math.random() * 256);
    var g = Math.floor(Math.random() * 256);
    var b = Math.floor(Math.random() * 256);
    var a = 0.7;
    return `rgba(${r}, ${g}, ${b}, ${a})`;
  }

  var backgroundColors = [];
  for (var i = 0; i < results.length; i++) {
      backgroundColors.push(randomRGBA());
  }

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: results.map(result => result.nome),
      datasets: [{
        data: results.map(result => result.count),
        backgroundColor: backgroundColors,
        borderColor: backgroundColors,
        borderWidth: 1,
      }],
    },
    options: {
      indexAxis: 'y',
      maintainAspectRatio : false,
      responsive : true,
      scales: {
        x: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Votos',
            font: {
              family: 'Arial',
              size: 24,
              color: 'black'
            }
          }
        },
        y: {
          beginAtZero: true,
          ticks: {
          font: {
            family: 'Palatino',
            size: 24,
            style: 'normal',
            weight: 'bold', 
          },
        },
        }
      },
      plugins: {
      legend: {
        display: false,
      },
    },
    },
  });
</script>
@endsection
