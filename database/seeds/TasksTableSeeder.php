<?php

use App\Project;
use App\Task;
use Illuminate\Database\Seeder;

// @phpcs:ignore PSR1.Classes.ClassDeclaration.MissingNamespace
class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Task::class, 100)->make()->each(function (Task $task): void {
            $project = Project::inRandomOrder()->first();

            $task->project_id = $project->id;

            if (rand() % ($project->tasks()->count() + 1)) {
                $task->parent_id = $project->tasks()->inRandomOrder()->first()->id;
            }

            $task->save();
        });
    }
}
