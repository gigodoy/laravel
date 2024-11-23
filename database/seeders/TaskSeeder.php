<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $user = User::first();  // Asegúrate de tener un usuario registrado

        foreach (range(1, 10) as $index) {
            Task::create([
                'user_id' => $user->id,
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'due_date' => $faker->date,
                'status' => 'pending',
                'priority' => 'medium',
            ]);
        }
    }
}
