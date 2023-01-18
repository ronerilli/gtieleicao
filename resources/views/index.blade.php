@extends('layout')

@section('content')

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login</title>
  </head>
  <body>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">Acesso</div>
            <div class="card-body">
              <div class="form-group">
                <button type="button" class="btn btn-primary btn-block" onclick="window.location='{{route('login-administrador')}}'">Acesso Administrador</button>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-primary btn-block" onclick="window.location='{{route('login-administrador')}}'">Acesso Eleitor</button>
              </div>
              <div class="form-group">
                <a href="{{route('create')}}" class="btn btn-secondary btn-block">Cadastro de Usuário</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
@endsection
