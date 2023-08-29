@extends('layout')

@section('content')
    <div class="slate-container">        
        <div class="slate-card card">
            <div class="slate-name">Nome da Chapa</div>
            <div class="candidate-card">
                <div class="candidate-photo">
                    <img src="candidate4.jpg" alt="Candidate 4">
                </div>
                <div class="candidate-name">Beltrano de Out</div>
                <button class="btn btn-warning btn-sm toggle-bio" data-bs-toggle="collapse" href="#candidato1" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Mostrar Biografia
                </button>
            </div>
            <div class="collapse overflow-y-auto" id="candidato1">
                    <div class="card card-body bio">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vehicula euismod purus, id efficitur risus imperdiet a. Maecenas mollis tempor erat, consequat efficitur felis fringilla at. Morbi placerat finibus lectus, faucibus maximus quam aliquet sit amet. Duis pellentesque massa metus, a sodales justo gravida eu. Nulla vel placerat nisi. Sed porttitor maximus tellus, sit amet porta diam iaculis sit amet. Sed porttitor est non ex vestibulum semper. Maecenas convallis vitae nunc non vulputate. Morbi at rutrum risus, eu varius sem. Donec et neque ultricies ipsum fringilla fermentum. Ut vel sollicitudin sem. Morbi et quam auctor, efficitur justo in, suscipit urna. Duis et ligula vitae odio auctor faucibus. Mauris fermentum facilisis lectus et volutpat. Donec suscipit rutrum mi. Nunc semper mattis orci, viverra mattis ipsum mollis scelerisque.
                    </div>
                    <a class="btn btn-light btn-sm more" href="#">Mostrar tudo</a>
            </div>
            <div class="candidate-card">
                <div class="candidate-photo">
                    <img src="candidate4.jpg" alt="Candidate 4">
                </div>
                <div class="candidate-name">Beltrano de Out</div>
                <button class="btn btn-warning btn-sm toggle-bio" data-bs-toggle="collapse" href="#candidato2" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Mostrar Biografia
                </button>
            </div>
            <div class="collapse overflow-y-auto" id="candidato2">
                    <div class="card card-body bio" id="biocandidato2">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vehicula euismod purus, id efficitur risus imperdiet a. Maecenas mollis tempor erat, consequat efficitur felis fringilla at. Morbi placerat finibus lectus, faucibus maximus quam aliquet sit amet. Duis pellentesque massa metus, a sodales justo gravida eu. Nulla vel placerat nisi. Sed porttitor maximus tellus, sit amet porta diam iaculis sit amet. Sed porttitor est non ex vestibulum semper. Maecenas convallis vitae nunc non vulputate. Morbi at rutrum risus, eu varius sem. Donec et neque ultricies ipsum fringilla fermentum. Ut vel sollicitudin sem. Morbi et quam auctor, efficitur justo in, suscipit urna. Duis et ligula vitae odio auctor faucibus. Mauris fermentum facilisis lectus et volutpat. Donec suscipit rutrum mi. Nunc semper mattis orci, viverra mattis ipsum mollis scelerisque.
                    </div>
                    <a class="btn btn-light btn-sm more" href="#">Mostrar tudo</a>
            </div>
            <button class="vote-button">Votar na Chapa</button>
        </div>
    </div> 
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleButtons = document.querySelectorAll('.toggle-bio');
            const showMore = document.querySelectorAll('.more');

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
        })
                        
    </script>
@endsection