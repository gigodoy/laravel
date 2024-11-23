<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDueDateToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Agregar la columna 'due_date' con tipo DATE (puedes usar TIMESTAMP si lo prefieres)
            $table->date('due_date')->nullable()->after('description'); // Cambia 'description' por la columna antes de la cual deseas agregar 'due_date'
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Eliminar la columna 'due_date' si revertimos la migración
            $table->dropColumn('due_date');
        });
    }
}
