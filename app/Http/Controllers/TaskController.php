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
        // Obtener todas las tareas del usuario autenticado (incluye borrado suave)
        $tasks = Task::where('user_id', Auth::id())->get();

        // Retornar la vista y pasar las tareas
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
        'status' => 'nullable|in:pending,in_progress,completed', // Agregado el estado como opcional
    ]);

    // Crear la tarea con los datos validados
    Task::create([
        'user_id' => Auth::id(),
        'title' => $validated['title'],
        'description' => $validated['description'],
        'due_date' => $validated['due_date'] ? Carbon::parse($validated['due_date']) : null, // Si no hay fecha de vencimiento, se coloca NULL
        'status' => $validated['status'] ?? 'pending', // Si no se establece estado, se asigna 'pending' por defecto
    ]);

    // Redirigir al listado de tareas con un mensaje de éxito
    return redirect()->route('tasks.index')->with('success', 'Tarea creada con éxito.');
}


    // Método para mostrar el formulario de edición de una tarea existente
    public function edit($id)
    {
        // Buscar la tarea por ID y asegurarse de que pertenece al usuario autenticado
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Retornar la vista de edición con la tarea
        return view('tasks.edit', compact('task'));
    }

    // Método para actualizar una tarea existente
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in_progress,completed', // Validación para el campo 'status'
        ]);
    
        // Encontrar la tarea por su ID
        $task = Task::findOrFail($id);
    
        // Actualizar la tarea con los datos validados
        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'] ?? null, // Si no hay fecha de vencimiento, se coloca NULL
            'status' => $validated['status'], // Actualizar el estado de la tarea
        ]);
    
        // Redirigir al listado de tareas con un mensaje de éxito
        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada con éxito.');
    }
    

    // Método para eliminar una tarea (borrado suave)
    public function destroy($id)
    {
        // Buscar la tarea por ID y asegurarse de que pertenece al usuario autenticado
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Eliminar la tarea suavemente (borrado suave)
        $task->delete();

        // Redirigir al listado de tareas con un mensaje de éxito
        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada con éxito.');
    }

    // Método para restaurar una tarea eliminada (borrado suave)
    public function restore($id)
    {
        // Buscar la tarea eliminada por ID, incluyendo las eliminadas suavemente
        $task = Task::withTrashed()->where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Restaurar la tarea
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
