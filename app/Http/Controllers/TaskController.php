<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function store(Request $request, $projectId)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:to_do,in_progress,done',
        ]);

        $validated['project_id'] = $projectId;

        return Task::create($validated);
    }

    public function show($id)
    {
        return Task::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:to_do,in_progress,done',
        ]);

        $task->update($validated);

        return $task;
    }

    public function destroy($id)
    {
        Task::destroy($id);
        return response()->noContent();
    }
}
