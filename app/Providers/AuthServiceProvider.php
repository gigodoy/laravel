<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate; // Agregar esta línea
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Task;
use App\Policies\TaskPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Task::class => TaskPolicy::class, // Mapea el modelo Task a la política TaskPolicy
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Registrar la política
        Gate::define('update-task', [TaskPolicy::class, 'update']);
    }
}
