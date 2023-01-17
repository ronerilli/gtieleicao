{{-- @extends('layout')

@section('content')
 --}}

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">Acesso</div>
            <div class="card-body">
              <div class="form-group">
                <button type="button" class="btn btn-primary btn-block" onclick="window.location='{{route('login')}}'">Acesso Administrador</button>
                <button type="button" class="btn btn-primary btn-block" onclick="window.location='{{route('voter.login')}}'">Acesso Eleitor</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

{{-- @endsection --}}
