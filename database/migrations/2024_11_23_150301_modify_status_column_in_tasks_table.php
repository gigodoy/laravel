<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending')->change();
        });
    }
    
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Revertir el cambio si es necesario
            $table->enum('status', ['pending', 'completed'])->default('pending')->change();
        });
    }
    
};
