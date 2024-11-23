<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relación con usuarios
            $table->string('title'); // Título de la tarea
            $table->text('description')->nullable(); // Descripción opcional
            $table->date('due_date'); // Fecha límite
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium'); // Prioridad
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');  // Asegúrate de que 'in_progress' esté incluido aquí
            $table->timestamps();
    
            // Llave foránea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
