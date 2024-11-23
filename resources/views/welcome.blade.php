@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Prueba Técnica Laravel/JS</h4>
                </div>
                <div class="card-body text-center">
                    <p class="mb-4">
                        ¡Bienvenido! Para comenzar, por favor 
                        <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">inicia sesión</a> 
                        o 
                        <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">regístrate</a>.
                    </p>
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">
                        <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-success btn-lg">
                        <i class="bi bi-person-plus"></i> Registrarse
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
