<?php

namespace App\Helpers;

class TaskHelper
{
    public static function translateStatus($status)
    {
        $translations = [
            'pending' => 'Pendiente',
            'completed' => 'Completada',
            'in_progress' => 'En Progreso',
        ];

        return $translations[$status] ?? $status; // Si no hay traducción, devuelve el valor original
    }

    public static function translatePriority($priority)
    {
        $translations = [
            'high' => 'Alta',
            'medium' => 'Media',
            'low' => 'Baja',
        ];

        return $translations[$priority] ?? $priority; // Si no hay traducción, devuelve el valor original
    }
}
