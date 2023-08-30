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
                <div class="candidate-card">
                    <div class="candidate-photo">
                        <img src="candidate4.jpg" alt="Candidate 4">
                    </div>
                    <div class="candidate-name">Beltrano de Out</div>
                    <button class="btn btn-warning btn-sm toggle-bio" data-bs-toggle="collapse" href="#candidato-{{ $chapa->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Mostrar Biografia
                    </button>
                </div>
                <div class="collapse overflow-y-auto" id="candidato-{{ $chapa->id }}">
                        <div class="card card-body bio">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vehicula euismod purus, id efficitur risus imperdiet a. Maecenas mollis tempor erat, consequat efficitur felis fringilla at. Morbi placerat finibus lectus, faucibus maximus quam aliquet sit amet. Duis pellentesque massa metus, a sodales justo gravida eu. Nulla vel placerat nisi. Sed porttitor maximus tellus, sit amet porta diam iaculis sit amet. Sed porttitor est non ex vestibulum semper. Maecenas convallis vitae nunc non vulputate. Morbi at rutrum risus, eu varius sem. Donec et neque ultricies ipsum fringilla fermentum. Ut vel sollicitudin sem. Morbi et quam auctor, efficitur justo in, suscipit urna. Duis et ligula vitae odio auctor faucibus. Mauris fermentum facilisis lectus et volutpat. Donec suscipit rutrum mi. Nunc semper mattis orci, viverra mattis ipsum mollis scelerisque.
                        </div>
                        <a class="btn btn-light btn-sm more" href="#">Mostrar tudo</a>
                </div>
                <form style="border: none;" method="POST" id="form-{{ $chapa->id }}" action="{{ route('votar-eleicao', ['id' => $eleicao->id]) }}">
                    @csrf
                    <input type="hidden" name="chapa_id" value="{{ $chapa->id }}">
                    <input type="hidden" name="eleicao_id" value="{{ $eleicao->id }}">
                </form>
                <button class="vote-button" id="{{ $chapa->id }}">Votar nesta chapa</button>
            </div>
        @endforeach
    </div> 
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
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
                    fetch("", {
                        method: "POST",
                        body: JSON.stringify(postdata),
                        headers: {
                            "Content-type": "application/json; charset=UTF-8"
                        }
                    }).then((response) => {
                        if (response.status == 200){
                            console.log("sucesso")
                        }
                    })
                });
            });
        })
                        
    </script>
@endsection