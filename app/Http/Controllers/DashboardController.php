<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get(); // Este filtrará automáticamente por 'deleted_at' siendo null
        return view('dashboard', compact('tasks'));
    }
}
