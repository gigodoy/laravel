@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Home') }}</div>

                    <div class="card-body">
                        @if (Route::has('login'))
                            @auth
                                <h2>Bienvenido, {{ Auth::user()->name }}</h2>
                            
                                <a href="{{ route('tasks.index') }}" class="btn btn-primary">Gestionar Tareas</a>
                                <a href="{{ route('dashboard') }}" class="btn btn-primary">Ver Tareas</a>
                            @else
                                <h2>Por favor, inicia sesión para acceder a tus tareas</h2>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
