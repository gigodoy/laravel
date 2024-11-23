@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>{{ __('Bienvenido') }}</h4>
                    </div>
                    <div class="card-body text-center">
                        @if (Route::has('login'))
                            @auth
                                <h2 class="mb-4">¡Hola, {{ Auth::user()->name }}!</h2>
                                <p class="mb-4">Administra tus tareas fácilmente desde aquí.</p>
                                
                                <div class="d-grid gap-3">
                                    <a href="{{ route('tasks.index') }}" class="btn btn-success btn-lg">
                                        <i class="bi bi-clipboard-check"></i> Gestionar Tareas
                                    </a>
                                    <a href="{{ route('dashboard') }}" class="btn btn-info btn-lg">
                                        <i class="bi bi-eye"></i> Ver Tareas
                                    </a>
                                </div>
                            @else
                                <h2 class="mb-4">¡Bienvenido a nuestro gestor de tareas!</h2>
                                <p class="text-muted mb-4">Por favor, inicia sesión para acceder a tus tareas.</p>
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
