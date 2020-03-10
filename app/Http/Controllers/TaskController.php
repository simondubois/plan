<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return TaskResource::collection(
            Task::query()
                ->when($request->project_id, function (Builder $query, $projectId): void {
                    $query->where('project_id', $projectId);
                })
                ->with('parent')
                ->get()
                ->sort([Task::class, 'sort'])
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }
}
