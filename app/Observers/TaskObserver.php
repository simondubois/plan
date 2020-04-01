<?php

namespace App\Observers;

use App\Task;

class TaskObserver
{
    public function creating(Task $task): void
    {
        $task->position = $task->siblings->count() + 1;
    }

    public function created(Task $task): void
    {
        $this->updateInheritance($task);
    }

    public function updating(Task $task): void
    {
        if ($task->isDirty('parent_id')) {
            $task->position = $task->siblings->count() + 1;
        }
    }

    public function updated(Task $task): void
    {
        $this->updateInheritance($task);
    }

    public function deleted(Task $task): void
    {
        $this->updateInheritance($task);
    }

    protected function updateInheritance(Task $task): void
    {
        $oldParent = Task::find($task->getOriginal('parent_id'));
        $newParent = Task::find($task->parent_id);

        optional($oldParent)->updateInheritance();

        if (optional($newParent)->isNot($oldParent)) {
            $newParent->updateInheritance();
        }

        if (is_null($oldParent) && is_null($newParent)) {
            $task->project->updateInheritance();
        }
    }
}
