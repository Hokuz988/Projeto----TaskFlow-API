<?php

namespace App\Services;
use App\Models\Project;
use App\Models\Task;
use App\Models\Tag;
use Illuminate\Validation\ValidationException;

class TagService
{
    public function getAll()
    {
        return Tag::all();
    }
    public function create($data)
    {
        return Tag::create($data);  
    }
    public function attachToTask(Task $task, Tag $tag)
    {
        if ($task->tags()->find($tag->id)) {
            throw ValidationException::withMessages(['tag' => 'Tag already attached to task']);
        }
        $task->tags()->attach($tag->id);
        return $task;
    }
    public function detachFromTask(Task $task, Tag $tag)
    {        $task->tags()->detach($tag->id);
        return $task;
    }
    public function update(Tag $tag, $data)
    {
        $tag->update($data);
        return $tag;
    }

    public function delete(Tag $tag)
    {
        $tag->delete();
    }
}