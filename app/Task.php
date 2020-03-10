<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'project_id' => 'integer',
        'parent_id' => 'integer',
        'position' => 'integer',
        'completion' => 'integer',
        'estimated_time' => 'integer',
        'spent_time' => 'integer',
        'start' => 'date',
        'end' => 'date',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'parent_id',
        'name',
        'position',
        'completion',
        'estimated_time',
        'spent_time',
        'start',
        'end',
    ];

    /**
     * Get the project owning the task.
     *
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the parent owning the task.
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Get the children for the task.
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_id');
    }

    /**
     * Append the position to the parent's code to generate the task's code in the project.
     *
     * @return String
     */
    public function getCodeAttribute(): string
    {
        if (is_null($this->parent)) {
            return $this->position;
        }

        return $this->parent->code . '.' . $this->position;
    }

    /**
     * Get the other tasks with the same parent as the current task.
     * If the current task has no parent, get all other tasks without parent for the same project.
     *
     * @return Collection
     */
    public function getSiblingsAttribute(): Collection
    {
        if ($this->parent) {
            return $this->parent
                ->children()
                ->where('id', '<>', $this->id)
                ->get();
        }

        return $this->project
            ->rootTasks()
            ->where('id', '<>', $this->id)
            ->get();
    }

    /**
     * Sort the two tasks by code.
     *
     * @return String
     */
    public static function sort(Task $taskA, Task $taskB): float
    {
        $codesA = explode('.', $taskA->code);
        $codesB = explode('.', $taskB->code);

        for ($key = 0; isset($codesA[$key]) && isset($codesB[$key]); ++$key) {
            if ($codesA[$key] !== $codesB[$key]) {
                return $codesA[$key] - $codesB[$key];
            }
        }

        return ($codesA[$key] ?? 0) - ($codesB[$key] ?? 0);
    }

    /**
     * Update the inherited attributes based on children values.
     *
     * @return void
     */
    public function updateInheritance(): void
    {
        $this->estimated_time = $this->children()->sum('estimated_time');
        $this->spent_time = $this->children()->sum('spent_time');
        if ($this->estimated_time === 0) {
            $this->completion = intval($this->children()->avg('completion'));
        }
        if ($this->estimated_time > 0) {
            $this->completion = $this->children()->sum(DB::raw('completion * estimated_time')) / $this->estimated_time;
        }
        $this->start = $this->children()->min('start');
        $this->end = $this->children()->max('end');
        $this->save();
    }
}
