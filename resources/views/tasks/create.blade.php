@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-4">Crear Nueva Tarea</h1>

  
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf 
        
        
        <div class="form-group mb-3">
            <label for="title" class="form-label">Título de la tarea</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

     
        <div class="form-group mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        
        <div class="form-group mb-3">
            <label for="due_date" class="form-label">Fecha de vencimiento</label>
            <input type="date" name="due_date" id="due_date" class="form-control @error('due_date') is-invalid @enderror" value="{{ old('due_date') }}">
            @error('due_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

      
        <div class="form-group mb-3">
            <label for="status" class="form-label">Estado</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pendiente</option>
                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>En progreso</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completada</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

       
        <div class="form-group mb-3">
            <label for="priority" class="form-label">Prioridad</label>
            <select name="priority" id="priority" class="form-control @error('priority') is-invalid @enderror" required>
                <option value="high" {{ old('priority', 'medium') == 'high' ? 'selected' : '' }}>Alta</option>
                <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Media</option>
                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Baja</option>
            </select>
            @error('priority')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Crear Tarea</button>
    </form>
</div>
@endsection

