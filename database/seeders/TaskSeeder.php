<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Task::create([
            'project_id' => 3,
            'title' => 'Task 1',
            'description' => 'Task 1 description',
            'assigned_to' => 5,
            'due_date' => now()->addDays(2),
            'status' => 'to_do'
        ]);
        Task::create([
            'project_id' => 3,
            'title' => 'Task 2',
            'description' => 'Task 2 description',
            'assigned_to' => 5,
            'due_date' => now(),
            'status' => 'in_progress'
        ]);
        Task::create([
            'project_id' => 3,
            'title' => 'Task 3',
            'description' => 'Task 3 description',
            'assigned_to' => 5,
            'due_date' => now(),
            'status' => 'done'
        ]);
    }
}
