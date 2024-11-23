<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusEnumInTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Alterar la columna 'status' para agregar 'in_progress'
        Schema::table('tasks', function (Blueprint $table) {
            $table->enum('status', ['pending', 'completed', 'in_progress'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // En caso de reversión, dejar solo 'pending' y 'completed'
        Schema::table('tasks', function (Blueprint $table) {
            $table->enum('status', ['pending', 'completed'])->default('pending')->change();
        });
    }
}
