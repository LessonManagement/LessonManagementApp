@extends('layouts.app')

@section('title', 'Email Verify - LessonManagement')

@section('content')

    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img
                        src="{{ url('assets/static/lm_logo.svg') }}" height="70" alt=""></a>
            </div>
            <div class="text-center">
                <div class="my-5">
                    <h2 class="h1">Revisa tu email</h2>
                    <p class="fs-h3 text-muted">
                        Por favor, verifica tu dirección de email desde el enlace enviado a tu correo electrónico. Si no lo
                        has recibido, <a id="resend-link" href="#" class="link">haz click aquí para solicitar otro.</a>
                        <script>
                            document.getElementById('resend-link').addEventListener('click', () => {
                                document.getElementById('resend_form').submit();
                            })
                        </script>
                    <form id="resend_form" class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                    </form>
                    </p>
                </div>
                <div class="text-center text-muted mt-3">
                    ¿No ves el email? Revisa tu bandeja de spam!!<br />
                </div>
            </div>
        </div>
    </div>
@endsection
