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
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <!-- Biblioteca de ícones -->
    <script src="{{ asset('js/all.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Estilos personalizados */
        body {
            background: #F5F5F5
        }
        .navbar {
            border-radius: 0;
            height: 50px;
        }

        .navbar-brand img {
            width: 150px;
            height: auto;
        }

        .nav-link {
            color: #fff;
            font-weight: 700;
        }

        .nav-link:hover {
            color: #f8f9fa;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-primary:focus {
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
        }

        /* Ajustes de espaçamento */
        .mt-5 {
            margin-top: 1rem;
        }

        .mb-5 {
            margin-bottom: 1rem;
        }

        .my-5 {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
        
        .slate-container {
            display: flex;
            flex-wrap: wrap;
        }

        .slate-card {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 10px;
            width: 400px;
        }

        .slate-name {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .candidate-card {
            border-top: 1px solid #ccc;
            padding: 10px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .candidate-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
        }

        .candidate-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .candidate-name {
            font-weight: bold;
        }

        .vote-button {
            background-color: #198754;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
        }

        .bio {
            height:100px;
            display:block;
            overflow:hidden;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-success" style="padding: 30px">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/logo.png" alt="Logo da empresa" style="width: 150px; height: auto; align: center;">
            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav" style="text-align: center">
                @auth
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('listar-eleicoes') }}">Manter Eleições</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('listar-candidatos') }}">Manter Candidatos</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Sair</a>
                    </li>
                </ul>
                @endauth
            </div>
        </div>
    </nav>
    

<div class="container my-5">
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
        
        </body>
        </html>