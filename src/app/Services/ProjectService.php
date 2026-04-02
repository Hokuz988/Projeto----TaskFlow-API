<?php

namespace App\Services;
use App\Models\Project;

class ProjectService
{
    public function getAllWithTaskCount()
    {
        return Project::with('user')->withCount('tasks')->get();
    }
    public function getByIdWithTasks($id)
    {
        return Project::with('tasks.tags')->findOrFail($id);
    }
    public function create($data)
    {
        return Project::create($data);
    }
    public function update($id, $data)
    {
        $project = Project::findOrFail($id);
        $project->update($data);
        return $project;
    }
    public function delete($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
    }
}