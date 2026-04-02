<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        $task = $this->taskService->getTasksByProject($project);
        return response()->json(['data' => $task]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'priority' => 'nullable|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);
        $task = $this->taskService->create($project, $data);
        return response()->json(['data' => $task], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Task $task)
    {
        if ($task->project_id != $project->id) {
            return response()->json(['message' => 'Tarefa não pertence a este projeto.'], 404);
        }
        return response()->json(['data' => $task->load('tags')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'status' => 'sometimes|required|in:pending,in_progress,completed',
            'priority' => 'sometimes|nullable|in:low,medium,high',
            'due_date' => 'sometimes|nullable|date',
        ]);
        $updated = $this->taskService->update($task, $data);
        return response()->json(['data' => $updated, 'message' => 'Tarefa atualizada.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Task $task)
    {
        if ($task->project_id != $project->id) {
            return response()->json(['message' => 'Tarefa não pertence a este projeto.'], 404);
        }
        $this->taskService->delete($task);
        return response()->json(['message' => 'Tarefa removida.'], 204);
    }
    public function updatedStatus(Request $request, Task $task)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);
        $updated = $this->taskService->update($task, $data);
        return response()->json(['data' => $updated, 'message' => 'Status da tarefa atualizado.']);
    }
}