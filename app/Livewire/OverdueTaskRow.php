<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\Computed;

class OverdueTaskRow extends Component
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

        // Notify parent via browser window event to avoid Alpine overlay flicker
        $this->dispatch('task-updated');
    }

    public function render()
    {
        return view('livewire.overdue-task-row');
    }
} 