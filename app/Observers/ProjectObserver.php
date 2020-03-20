<?php

namespace App\Observers;

use App\Project;

class ProjectObserver
{
    public function deleting(Project $project): void
    {
        $project->tasks()->delete();
    }
}
