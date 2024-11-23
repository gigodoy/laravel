<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
         //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task)
    {
        return $user->id === $task->user_id; // Verifica que el usuario sea dueño de la tarea
    }
    
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
         // Verificar que el usuario autenticado sea el propietario de la tarea
    return $user->id === $task->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        //
    }
}
