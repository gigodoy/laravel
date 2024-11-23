@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tareas</h1>
    <p>Tareas Asignadas a : {{ Auth::user()->name }}</p>
    <a href="{{ route('home') }}" class="btn btn-primary mb-3">Volver</a>

    @if ($tasks->isEmpty())
        <p class="text-center">No hay tareas registradas para este usuario</p>
    @else
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Priority</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->priority }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
