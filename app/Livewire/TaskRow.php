<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\Computed;

class TaskRow extends Component
{
    public Task $task;

    public function mount(Task $task)
    {
        $this->task = $task;
    }

    #[Computed]
    public function isCompleted()
    {
        return $this->task->isCompleted();
    }

    public function toggleCompletion()
    {
        if ($this->task->isCompleted()) {
            $this->task->update(['completed_at' => null]);
        } else {
            $this->task->update(['completed_at' => now()]);
        }
        
        $this->task->refresh();
    }

    public function render()
    {
        return view('livewire.task-row');
    }
} 