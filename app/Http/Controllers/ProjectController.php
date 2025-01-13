<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:open,in_progress,completed',
        ]);

        return Project::create($validated);
    }

    public function show($id)
    {
        return Project::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:open,in_progress,completed',
        ]);

        $project->update($validated);

        return $project;
    }

    public function destroy($id)
    {
        Project::destroy($id);
        return response()->noContent();
    }
}
