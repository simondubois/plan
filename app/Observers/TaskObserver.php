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
        $siblings = (optional(Task::find($task->getOriginal('parent_id')))->children ?? $task->project->rootTasks)
            ->where('id', '!==', $task->id);
        $oldPosition = $task->getOriginal('position');
        $newPosition = $task->position;

        if ($task->wasChanged('parent_id')) {
            Task::query()
                ->whereKey($siblings->modelKeys())
                ->where('position', '>', $oldPosition)
                ->decrement('position');
        } elseif ($newPosition > $oldPosition) {
            Task::query()
                ->whereKey($siblings->modelKeys())
                ->where('position', '>', $oldPosition)
                ->where('position', '<=', $newPosition)
                ->decrement('position');
        } elseif ($newPosition < $oldPosition) {
            Task::query()
                ->whereKey($siblings->modelKeys())
                ->where('position', '<', $oldPosition)
                ->where('position', '>=', $newPosition)
                ->increment('position');
        }

        $this->updateInheritance($task);
    }

    public function deleted(Task $task): void
    {
        Task::query()
            ->whereKey($task->siblings->modelKeys())
            ->where('position', '>', $task->position)
            ->decrement('position');

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
