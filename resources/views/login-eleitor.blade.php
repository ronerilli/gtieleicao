@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Autenticação Necessária</div>
                        <div class="card-body">
                            <form action="{{ route('enviar-codigo-sms') }}" class="row g-5" method="POST">
                                @csrf
                                <div class="col-8">
                                    <input type="text" class="form-control" id="matricula" name="matricula" placeholder="Por favor, informe a sua Matrícula">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-success mb-3">Enviar Código SMS</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('error'))
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Erro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('#errorModal').modal('show');
            });
        </script>
    @endif

    @if (session('success'))
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Insira o Código SMS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('authenticate-eleitor') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="codigo_sms">Código SMS</label>
                                <input type="text" class="form-control row" name="codigo_sms" id="codigo_sms" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('#successModal').modal('show'); 
            });
        </script>
    @endif
@endsection