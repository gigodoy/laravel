<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    // Definir los campos que son asignables masivamente
    protected $fillable = [
        'title', 'description', 'due_date', 'status', 'priority', 'user_id'
    ];

    // Para convertir automáticamente 'due_date' en un objeto Carbon (para manipular fechas fácilmente)
    protected $dates = ['due_date'];

    // Relación con el modelo de usuario (usuario que creó la tarea)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function getTasksForAuthenticatedUser()
    {
        return self::where('user_id', Auth::id())->get();
    }

    public function getDueDateAttribute($value)
    {
        // Devuelve la fecha en el formato 'Y-m-d' (ej. 2024-11-23)
        return Carbon::parse($value)->format('Y-m-d');
    }

    // Mutador para formatear la fecha de vencimiento antes de guardarla en la base de datos
    public function setDueDateAttribute($value)
    {
        // Convierte el valor de 'due_date' en un objeto Carbon antes de guardarlo
        $this->attributes['due_date'] = Carbon::parse($value);
    }
}
