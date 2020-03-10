<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
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
    protected $fillable = ['name'];

    /**
     * Get the tasks for the project.
     *
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the tasks without parent for the project.
     *
     * @return HasMany
     */
    public function rootTasks(): HasMany
    {
        return $this->tasks()
            ->whereDoesntHave('parent');
    }

    /**
     * Update the inherited attributes based on root tasks values.
     *
     * @return void
     */
    public function updateInheritance(): void
    {
        $this->estimated_time = $this->rootTasks()->sum('estimated_time');
        $this->spent_time = $this->rootTasks()->sum('spent_time');
        if ($this->estimated_time === 0) {
            $this->completion = intval($this->rootTasks()->avg('completion'));
        }
        if ($this->estimated_time > 0) {
            $this->completion = $this->rootTasks()->sum(DB::raw('completion * estimated_time')) / $this->estimated_time;
        }
        $this->start = $this->rootTasks()->min('start');
        $this->end = $this->rootTasks()->max('end');
        $this->save();
    }
}
