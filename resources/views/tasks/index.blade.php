@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3">Mis Tareas</h2>
        <div>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary me-2">
                <i class="bi bi-plus-circle"></i> Agregar Nueva Tarea
            </a>
            <a href="{{ route('home') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    @if ($tasks->isEmpty())
        <div class="alert alert-warning text-center">
            <i class="bi bi-info-circle"></i> No tienes tareas asignadas.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Fecha de Vencimiento</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Prioridad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge 
                                    @if($task->status === 'pending') bg-danger text-light 
                                    @elseif($task->status === 'completed') bg-success 
                                    @elseif($task->status === 'in_progress') bg-warning text-dark 
                                    @else bg-secondary 
                                    @endif">
                                    {{ \App\Helpers\TaskHelper::translateStatus($task->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge 
                                    @if($task->priority === 'high') bg-danger 
                                    @elseif($task->priority === 'medium') bg-warning text-dark 
                                    @else bg-success 
                                    @endif">
                                    {{ \App\Helpers\TaskHelper::translatePriority($task->priority) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

