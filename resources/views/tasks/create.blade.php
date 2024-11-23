@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Tarea</h1>

    <!-- Formulario para crear una nueva tarea -->
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf <!-- Protección contra CSRF -->
        
        <div class="form-group">
            <label for="title">Título de la tarea</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="due_date">Fecha de vencimiento</label>
            <input type="date" name="due_date" id="due_date" class="form-control @error('due_date') is-invalid @enderror" value="{{ old('due_date') }}">
            @error('due_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Agregar el campo para seleccionar el estado -->
        <div class="form-group mt-3">
            <label for="status">Estado</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pendiente</option>
                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>En progreso</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completada</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botón para enviar el formulario -->
        <button type="submit" class="btn btn-primary mt-3">Crear Tarea</button>
    </form>

</div>
@endsection
