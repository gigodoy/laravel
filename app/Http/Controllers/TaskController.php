<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('tasks.index', compact('tasks'));
    }
    public function create()
    {
        return view('tasks.create');
    }
    public function store(Request $request)
    {
            $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'nullable|in:pending,in_progress,completed',
            'priority' => 'required|in:high,medium,low', // Añadido el campo de prioridad
        ]);
        Task::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'] ? Carbon::parse($validated['due_date']) : null,
            'status' => $validated['status'] ?? 'pending', // Establece 'pending' si no se proporciona estado
            'priority' => $validated['priority'], // Añadir prioridad
        ]);
        return redirect()->route('tasks.index')->with('success', 'Tarea creada con éxito.');
    }
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in_progress,completed',
            'priority' => 'required|in:high,medium,low',
        ]);
        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'] ? Carbon::parse($validated['due_date']) : null,
            'status' => $validated['status'],
            'priority' => $validated['priority'],
        ]);
        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada con éxito.');
    }
    
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada con éxito.');
    }
    public function restore(Task $task)
    {
        $this->authorize('restore', $task);
        $task->restore();
        return redirect()->route('tasks.index')->with('success', 'Tarea restaurada con éxito.');
    }

    public function trashed()
    {
        $tasks = Task::onlyTrashed()->where('user_id', Auth::id())->get();
        return view('tasks.trashed', compact('tasks'));
    }
}

