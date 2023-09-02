@extends('layout')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
          <div class="chart-container">
            <canvas id="electionChart" width="400" height="400"></canvas>
          </div>
  </div>
</div>
<script>
  var ctx = document.getElementById('electionChart').getContext('2d');
  var results = @json($results);
  function randomRGBA() {
    var r = Math.floor(Math.random() * 256);
    var g = Math.floor(Math.random() * 256);
    var b = Math.floor(Math.random() * 256);
    var a = 1.0;
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
      scales: {
        x: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Votos',
          },
        },
        y: {
          beginAtZero: true,
        },
      },
    },
  });
</script>
@endsection
