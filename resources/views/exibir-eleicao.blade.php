@extends('layout')

@section('content')
    <h1 class="text-center text-body-secondary">Eleição {{ $eleicao->nome }}</h1>
    <br>
    <br>
    <h3 class="text-center text-body-secondary">Escolha sua chapa</h3>
    <div class="slate-container">
    @foreach ($chapas as $chapa)
            <div class="col-12 col-md-4">
                <div class="slate-card card">
                            <div class="slate-name text-body-secondary text-md text-sm">{{ $chapa->nome }}</div>
                    <div class="row">
                        @foreach ($candidatos as $candidato)
                            @if ($candidato->chapa_id == $chapa->id)
                                    <div class="candidate-card card">
                                        <div class="candidate-photo">
                                            <img src="{{ $candidato->foto }}" alt="Candidate 4" class="card-img-top">
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
                            @endif
                        @endforeach
                    </div>
                    <form style="border: none;" method="POST" id="form-{{ $chapa->id }}" action="{{ route('votar-eleicao', ['id' => $eleicao->id]) }}">
                        @csrf
                        <input type="hidden" name="chapa_id" value="{{ $chapa->id }}">
                        <input type="hidden" name="eleicao_id" value="{{ $eleicao->id }}">
                    </form>
                    <br>
                    <button class="vote-button btn btn-success btn-lg" @if (auth()->user()->votou == 1) disabled @endif id="{{ $chapa->id }}">@if (auth()->user()->votou == 1) Você já votou @else Votar nesta chapa @endif</button>
                </div>
            </div>
        @endforeach
    </div> 
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const voteBtn = document.querySelectorAll('.vote-button');

    voteBtn.forEach(button => {
        button.addEventListener('click', () => {
            let campos = document.getElementById(`form-${button.id}`).elements
            let postdata = {}
            for (let i = 0; i < campos.length; i++){
                postdata[campos[i].name] = campos[i].value
            }
            console.log("bateu aqui")
            $.post("", postdata)
                .done(function(data){
                    if (data.status == 201){
                        openSuccessModal(data.message)
                        $(".vote-button").prop('disabled', true)
                        $(".vote-button").text('Você já votou')
                    }
                    else {
                        openErrorModal(data.message)
                    }
                })
                
        });
    });
})
    </script>
@endsection