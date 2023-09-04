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
    <script src="{{ asset('js/chart.js') }}"></script>
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

        .nav-link,.saudacao{
            color: #fff;
            font-weight: 700;
        }

        .saudacao{
            color: #fff;
            font-weight: 500;
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
            padding: 15px;
            text-align: center;
            margin: 8px;
        }

        #electionChart {
            /* margin: 20px; */
            padding: 20px;
            /* padding-top: 30px; */
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }
        
        .slate-name.text-body-secondary {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 30px;
        }

        .candidate-card {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .candidate-photo {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            overflow: hidden;
        }

        .candidate-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slate-name {
            text-align: center; /* Center the text */
            padding: 20px; /* Add padding for spacing */
            font-size: 36px; /* Font size */
            font-family: "Arial", sans-serif; /* Font family */
            letter-spacing: 2px; /* Adjust letter spacing */
            text-transform: uppercase; /* Convert text to uppercase */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Text shadow for depth */
        }

        /* .bio {
            height:100px;
            display:block;
            overflow:hidden;
        } */
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-success" style="padding: 30px">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/logo.png" alt="Logo da empresa" class="img-fluid" style="max-width: 150px; height: auto;">
            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @auth
                @if (auth()->user()->profile == 'admin' || auth()->user()->profile == 'power')
                    <div class="collapse navbar-collapse" id="navbarNav" style="text-align: center">
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
                @endif
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Sair</a>
                        </li>
                    </ul>
                </div>
                <div class="saudacao">{{ auth()->user()->name }}</div>
            @endauth
        </div>
    </nav>
    <button type="button" id="modalButton" style="display: none" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    </button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" id="modalOk" class="btn" data-bs-dismiss="modal">Entendi</button>
            </div>
            </div>
        </div>
    </div>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            @yield('content')
        </div>
        </div>
        </div>
        <script>
            function openErrorModal(message){
                classes = $("#modalOk").attr("class")
                if (classes.includes("primary")){
                    $("#modalOk").removeClass("btn-primary")
                    $("#modalOk").addClass("btn-danger")
                }
                else {
                    $("#modalOk").addClass("btn-danger")
                }
                $(".modal-title").text("Erro")
                $(".modal-body").text(message)
                $("#modalButton").trigger( "click" )
            }
            function openSuccessModal(message){
                classes = $("#modalOk").attr("class")
                if (classes.includes("danger")){
                    $("#modalOk").removeClass("btn-danger")
                    $("#modalOk").addClass("btn-primary")
                }
                else {
                    $("#modalOk").addClass("btn-primary")
                }
                $(".modal-title").text("Sucesso")
                $(".modal-body").text(message)
                $("#modalButton").trigger( "click" )
            }
        </script>
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