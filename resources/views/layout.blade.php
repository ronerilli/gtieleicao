<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema de Votação</title>
    <!-- Fonte -->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap" rel="stylesheet">
    <!-- CSS do Bootstrap e personalização -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->
    <!-- Biblioteca de ícones -->
    <script src="{{ asset('js/all.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-success">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="logo.png" alt="Logo da empresa" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('listar-eleicoes') }}">Manter Eleições</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('listar-candidatos') }}">Manter Candidatos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Sair</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- <footer class="bg-success text-white py-3 fixed-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 text-center text-md-left">
                <p>&copy; Grünti Technology 2023</p>
            </div>
        </div>
    </div>
    </footer> -->


    
