<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskRow extends Component
{
    public Task $task;
    public bool $completed;

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->completed = $task->isCompleted();
    }

    public function toggleCompletion()
    {
        $this->completed = !$this->completed;
        
        if ($this->completed) {
            $this->task->update(['completed_at' => now()]);
        } else {
            $this->task->update(['completed_at' => null]);
        }
        
        // Refresh the task model to get updated data
        $this->task->refresh();
        
        // Emit event to refresh parent component sorting
        $this->dispatch('task-completion-toggled');
    }

    public function render()
    {
        return view('livewire.task-row');
    }
} 