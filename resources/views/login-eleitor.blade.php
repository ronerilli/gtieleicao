@extends('layout')

@section('content')
    <form action="{{ route('enviar-codigo-sms') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="matricula">Favor informe a sua Matrícula</label>
            <input type="text" class="form-control" name="matricula" id="matricula" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Código SMS</button>
    </form>
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
                            <input type="text" class="form-control" name="codigo_sms" id="codigo_sms" required>
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
