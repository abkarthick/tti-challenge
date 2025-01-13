<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Project::create([
            'title' => 'Project 1',
            'description' => 'Description for Project 1',
            'status' => 'open'
        ]);
        Project::create([
            'title' => 'Project 2',
            'description' => 'Description for Project 2',
            'status' => 'in_progress'
        ]);
        Project::create([
            'title' => 'Project 3',
            'description' => 'Description for Project 3',
            'status' => 'completed'
        ]);
    }
}
