<?php

namespace App\Services;
use App\Models\User;

class UserService
{
    public function create($data)
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function getAll()
    {
        return User::withCount('projects', 'tasks')->get();
    }

    public function getByIdWithProjectsAndTasks($id)
    {
        return User::with('projects.tasks', 'tasks.project')->findOrFail($id);
    }

    public function update(User $user, $data)
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        
        $user->update($data);
        return $user;
    }

    public function delete(User $user)
    {
        $user->delete();
    }

    public function getUserProjects(User $user)
    {
        return $user->projects()->withCount('tasks')->get();
    }

    public function getUserTasks(User $user)
    {
        return $user->tasks()->with('project', 'tags')->get();
    }
}
