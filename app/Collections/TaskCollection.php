<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class TaskCollection extends Collection
{
    public function __construct($items)
    {
        parent::__construct($items);
    }

    public function getTodayTasks()
    {
        return $this->filter(function ($task) {
            return $task->start_at?->isToday() === true;
        });
    }

    public function getOverdueTasks()
    {
        return $this->filter(function ($task) {
            return $task->start_at?->isPast() === true && $task->completed_at === null;
        });
    }

    public function getCompletedTasks()
    {
        return $this->filter(function ($task) {
            return $task->completed_at !== null;
        });
    }

    public function getInProgressTasks()
    {
        return $this->filter(function ($task) {
            return $task->start_at !== null && $task->completed_at === null;
        });
    }

    public function getNotInProgressTasks()
    {
        return $this->filter(function ($task) {
            return $task->start_at === null || $task->completed_at !== null;
        });
    }

    public function getNotOverdueTasks()
    {
        return $this->filter(function ($task) {
            return $task->start_at?->isFuture() === true;
        });
    }

    public function summary()
    {
        return [
            'total' => $this->count(),
            'completed' => $this->getCompletedTasks()->count(),
            'in_progress' => $this->getInProgressTasks()->count(),
            'not_in_progress' => $this->getNotInProgressTasks()->count(),
            'overdue' => $this->getOverdueTasks()->count(),
            'not_overdue' => $this->getNotOverdueTasks()->count(),
        ];
    }
}
