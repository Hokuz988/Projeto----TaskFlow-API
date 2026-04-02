<?php

namespace App\Services;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Validation\ValidationException;
class TaskService
{
    public function getTasksByProject(Project $project)
    {
        return Task::with('tags')->where('project_id', $project->id)->get();
    }
    public function create(Project $project, $data)
    {
        $data['project_id'] = $project->id;
        return Task::create($data);
    }
    public function update(Task $task, $data)
    {
        $task->update($data);
        return $task;
    }
    public function delete(Task $task)
    {        $task->delete();
    }
    public function updateStatus(Task $task, $status)
    {
        if (!in_array($status, ['pending', 'in_progress', 'completed'])) {
            throw ValidationException::withMessages(['status' => 'Invalid status']);
        }
        $task->status = $status;
        $task->save();
        return $task;
    }

}