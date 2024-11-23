<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_deleted_at_to_tasks_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->softDeletes(); // Agrega la columna 'deleted_at'
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Elimina la columna 'deleted_at'
        });
    }
}

