<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{
    // Constructor para asegurar que el usuario esté autenticado
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Método para mostrar todas las tareas del usuario autenticado
    public function index()
    {
        // Obtener todas las tareas del usuario autenticado
        $tasks = Task::where('user_id', Auth::id())->get();

        // Pasar las tareas a la vista 'tasks.index'
        return view('tasks.index', compact('tasks'));
    }

    // Método para mostrar el formulario de creación de una nueva tarea
    public function create()
    {
        return view('tasks.create');
    }

    // Método para almacenar una nueva tarea
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'nullable|in:pending,in_progress,completed',
            'priority' => 'required|in:high,medium,low', // Añadido el campo de prioridad
        ]);

        // Crear la tarea con los datos validados
        Task::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'] ? Carbon::parse($validated['due_date']) : null,
            'status' => $validated['status'] ?? 'pending', // Establece 'pending' si no se proporciona estado
            'priority' => $validated['priority'], // Añadir prioridad
        ]);

        // Redirigir al listado de tareas con un mensaje de éxito
        return redirect()->route('tasks.index')->with('success', 'Tarea creada con éxito.');
    }

    // Método para mostrar el formulario de edición de una tarea existente
    public function edit($id)
    {
        // Obtener la tarea específica por ID
        $task = Task::findOrFail($id);

        // Retornar la vista de edición con la tarea específica
        return view('tasks.edit', compact('task'));
    }


    // Método para actualizar una tarea existente
    public function update(Request $request, Task $task)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in_progress,completed',
            'priority' => 'required|in:high,medium,low',
        ]);
    
        // Actualizar la tarea con los datos validados
        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'] ? Carbon::parse($validated['due_date']) : null,
            'status' => $validated['status'],
            'priority' => $validated['priority'],
        ]);
    
        // Redirigir a la vista de tareas con un mensaje de éxito
        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada con éxito.');
    }
    

    // Método para eliminar una tarea (borrado suave)
    public function destroy(Task $task)
    {
        // Verificar que la tarea pertenece al usuario autenticado
        $this->authorize('delete', $task);

        // Eliminar la tarea suavemente
        $task->delete();

        // Redirigir al listado de tareas con un mensaje de éxito
        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada con éxito.');
    }

    // Método para restaurar una tarea eliminada (borrado suave)
    public function restore(Task $task)
    {
        // Verificar que la tarea pertenece al usuario autenticado
        $this->authorize('restore', $task);

        // Restaurar la tarea eliminada
        $task->restore();

        // Redirigir al listado de tareas con un mensaje de éxito
        return redirect()->route('tasks.index')->with('success', 'Tarea restaurada con éxito.');
    }

    // Método para mostrar todas las tareas eliminadas (borrado suave)
    public function trashed()
    {
        // Obtener todas las tareas eliminadas suavemente
        $tasks = Task::onlyTrashed()->where('user_id', Auth::id())->get();

        // Retornar la vista con las tareas eliminadas
        return view('tasks.trashed', compact('tasks'));
    }
}

