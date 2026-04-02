<?php

    namespace App\Http\Controllers;

    use  App\Services\TagService;
    use App\Models\Task;
    use App\Models\Tag;
    use Illuminate\Http\Request;

    class TagController extends Controller
    {
        protected $tagService;

        public function __construct(TagService $tagService)
        {
            $this->tagService = $tagService;
        }

        public function index()
        {
        $tags = $this->tagService->getAll();
        return response()->json(['data' => $tags]);
        }

        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'color' => 'nullable|string|max:7',
            ]);

            $tag = $this->tagService->create($validatedData);
            return response()->json(['data' => $tag, 'message' => 'Tag criada com sucesso.']);
        }

        public function attachToTask(Request $request, Task $task, Tag $tag)
        {
            $this->tagService->attachToTask($task, $tag);
            return response()->json(['message' => 'Tag anexada à tarefa com sucesso.']);
        }

        public function detachFromTask(Request $request, Task $task, Tag $tag)
        {
            $this->tagService->detachFromTask($task, $tag);
            return response()->json(['message' => 'Tag removida da tarefa com sucesso.']);
        }
    }