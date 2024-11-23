@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Prueba Tecnica Laravel/JS</div>
                <div class="card-body">
                    <p>Para comenzar, <a href="{{ route('login') }}">inicia sesión</a> o <a href="{{ route('register') }}">regístrate</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
