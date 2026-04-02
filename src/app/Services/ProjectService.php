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
    public function update($project, $data)
    {
        $project->update($data);
        return $project;
    }
    public function delete($project)
    {
        $project->delete();
    }
}