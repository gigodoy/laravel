@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3">Editar Tarea</h2>
        <div>
            <a href="{{ route('tasks.index') }}" class="btn btn-primary me-2">
                <i class="bi bi-arrow-left"></i> Volver a la lista de tareas
            </a>
        </div>
    </div>

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Formulario para editar la tarea -->
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')  <!-- Especificamos que es una actualización -->

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $task->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea id="description" name="description" class="form-control" required>{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Fecha de vencimiento</label> 
            <input type="date" id="due_date" name="due_date" class="form-control" 
                value="{{ old('due_date', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}" 
                required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Estado</label>
            <select id="status" name="status" class="form-control">
                <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pendiente</option>
                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>En progreso</option>
                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completada</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Prioridad</label>
            <select id="priority" name="priority" class="form-control">
                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>Alta</option>
                <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Media</option>
                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Baja</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Tarea</button>
    </form>
</div>
@endsection

