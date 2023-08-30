@extends('layout')

@section('content')
    <h1 class="text-center text-body-secondary">Eleição {{ $eleicao->nome }}</h1>
    <br>
    <br>
    <h3 class="text-center text-body-secondary">Escolha sua chapa</h3>
    <div class="slate-container">
        @foreach ($chapas as $chapa)
            <div class="slate-card card">
                <div class="slate-name">{{ $chapa->nome }}</div>
                @foreach ($candidatos as $candidato)
                    @if ($candidato->chapa_id == $chapa->id)
                        <div class="candidate-card">
                            <div class="candidate-photo">
                                <img src="/{{ $candidato->foto }}" alt="Candidate 4">
                            </div>
                            <div class="candidate-name">{{ $candidato->nome_completo }}</div>
                            <button class="btn btn-warning btn-sm toggle-bio" data-bs-toggle="collapse" href="#candidato-{{ $candidato->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Mostrar Biografia
                            </button>
                        </div>
                        <div class="collapse overflow-y-auto" id="candidato-{{ $candidato->id }}">
                                <div class="card card-body bio">
                                    {{ $candidato->biografia }}
                                </div>
                                <a class="btn btn-light btn-sm more" href="#">Mostrar tudo</a>
                        </div>
                    @endif
                @endforeach
                <form style="border: none;" method="POST" id="form-{{ $chapa->id }}" action="{{ route('votar-eleicao', ['id' => $eleicao->id]) }}">
                    @csrf
                    <input type="hidden" name="chapa_id" value="{{ $chapa->id }}">
                    <input type="hidden" name="eleicao_id" value="{{ $eleicao->id }}">
                </form>
                <button class="vote-button" id="{{ $chapa->id }}">Votar nesta chapa</button>
            </div>
        @endforeach
    </div> 
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleButtons = document.querySelectorAll('.toggle-bio');
            const showMore = document.querySelectorAll('.more');
            const voteBtn = document.querySelectorAll('.vote-button');

            toggleButtons.forEach(button => {
                button.addEventListener('click', () => {
                    if (button.innerText == 'Mostrar Biografia') {
                        button.innerText = 'Ocultar Biografia';
                    } else {
                        button.innerText = 'Mostrar Biografia';
                    }
                });
            });
            showMore.forEach(button => {
                button.addEventListener('click', () => {
                    bio = button.previousSibling.previousSibling
                    if (button.innerText == 'Mostrar tudo') {
                        bio.style.height = 'auto' 
                        button.innerText = 'Mostrar menos';
                    } else {
                        bio.style.height = '100px'
                        button.innerText = 'Mostrar tudo';
                    }
                });
            });
            voteBtn.forEach(button => {
                button.addEventListener('click', () => {
                    let campos = document.getElementById(`form-${button.id}`).elements
                    let postdata = {}
                    for (let i = 0; i < campos.length; i++){
                        postdata[campos[i].name] = campos[i].value
                    }

                    $.post("", postdata)
                        .done(function(data){
                            if (data.status == 201){
                                openSuccessModal(data.message)
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