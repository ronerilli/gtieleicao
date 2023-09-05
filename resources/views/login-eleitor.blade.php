@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="/logo.png" alt="Company Logo" width="200">
                        <h3 class="mt-2">Sistema de Eleições</h3>
                    </div>
                    <form action="{{ route('enviar-codigo-sms') }}" method="POST">
                        @csrf
                        <div class="row g-2">
                            <div class="col-12 col-sm-8">
                                <input type="text" class="form-control" id="matricula" name="matricula" placeholder="Por favor, informe a sua Matrícula" required>
                            </div>
                            <div class="col-12 col-sm-4">
                                <button type="submit" class="btn btn-success d-block w-100">Receber Código SMS</button>
                            </div>
                        </div>
                    </form>
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
            </div>
            <div class="modal-body justify-content-center">
                <form action="{{ route('authenticate-eleitor') }}" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col-12 col-sm-8">
                            <input type="text" class="form-control" id="codigo_sms" name="codigo_sms" placeholder="Informe o código recebido" required>
                        </div>
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn btn-success d-block w-100">Entrar</button>
                        </div>
                    </div>
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