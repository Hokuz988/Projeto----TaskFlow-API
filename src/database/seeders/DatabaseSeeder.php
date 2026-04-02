<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {   
        // Cria um conjunto fixo de tags (por exemplo, 10 tags)
        $tags = Tag::factory(10)->create(); // garante nomes únicos no factory

        $users = User::factory(10)->create();
        foreach ($users as $user) {
            $user->profile()->create([
                'bio' => fake()->paragraph(),
                'phone' => fake()->phoneNumber(),
                'avatar' => fake()->imageUrl(),
            ]);

            $projects = Project::factory(3)->create(['user_id' => $user->id]);
            foreach ($projects as $project) {
                $tasks = Task::factory(5)->create(['project_id' => $project->id]);
                foreach ($tasks as $task) {
                    $randomTags = $tags->random(rand(1, 3));
                    $task->tags()->attach($randomTags->pluck('id')->toArray());
                }
            }
        }
    }
}