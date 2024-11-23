@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Tareas</h1>
        <a href="{{ route('home') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <p class="fw-semibold">Tareas asignadas a: <span class="text-primary">{{ Auth::user()->name }}</span></p>

    @if ($tasks->isEmpty())
        <div class="alert alert-warning text-center">
            <i class="bi bi-info-circle"></i> No hay tareas registradas para este usuario.
        </div>
    @else
        <div class="table-responsive">
            <!-- Se agregan las clases table-bordered y table-sm para bordes y mayor separación -->
            <table class="table table-bordered table-striped table-hover table-sm">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Fecha de Vencimiento</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Prioridad</th>
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
                                    @elseif($task->status === 'in_progress') bg-warning text-dark 
                                    @elseif($task->status === 'completed') bg-success 
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
