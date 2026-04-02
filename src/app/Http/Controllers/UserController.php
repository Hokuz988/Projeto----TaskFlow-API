<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAll();
        return response()->json(['data' => $users]);
    }

    public function show(User $user)
    {
        return response()->json(['data' => $user->load('projects', 'tasks')]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:6|confirmed',
        ]);

        $updated = $this->userService->update($user, $validated);
        return response()->json(['data' => $updated, 'message' => 'Usuário atualizado.']);
    }

    public function destroy(User $user)
    {
        $this->userService->delete($user);
        return response()->json(['message' => 'Usuário removido.'], 204);
    }

    public function projects(User $user)
    {
        $projects = $this->userService->getUserProjects($user);
        return response()->json(['data' => $projects]);
    }

    public function tasks(User $user)
    {
        $tasks = $this->userService->getUserTasks($user);
        return response()->json(['data' => $tasks]);
    }
}
