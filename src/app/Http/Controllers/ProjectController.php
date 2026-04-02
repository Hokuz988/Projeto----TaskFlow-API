<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index()
    {
        $projects = $this->projectService->getAllWithTaskCount();
        return response()->json(['data' => $projects]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:open,in_progress,completed',
            'deadline' => 'nullable|date',
        ]);

        $project = $this->projectService->create($validated);
        return response()->json(['data' => $project, 'message' => 'Projeto criado com sucesso.'], 201);
    }

    public function show(Project $project)
    {
        // Injeção de modelo já busca o projeto
        return response()->json(['data' => $project->load('user', 'tasks')]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:open,in_progress,completed',
            'deadline' => 'nullable|date',
        ]);

        $updated = $this->projectService->update($project, $validated);
        return response()->json(['data' => $updated, 'message' => 'Projeto atualizado.']);
    }

    public function destroy(Project $project)
    {
        $this->projectService->delete($project);
        return response()->json(['message' => 'Projeto removido.'], 204);
    }
}