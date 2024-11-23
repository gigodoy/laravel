<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Recuperar las tareas del usuario autenticado, incluyendo las eliminadas suavemente
        $tasks = Task::where('user_id', Auth::id())->get(); // Este filtrará automáticamente por 'deleted_at' siendo null

        // Renderizar la vista del dashboard y pasarle las tareas
        return view('dashboard', compact('tasks'));
    }
}
