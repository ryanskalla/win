<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\On;

final class Dashboard extends Component
{
    #[On('task-created')]
    public function refreshTasks(): void {}

    public function render()
    {
        $todayTasks = Task::withToday()->get();
        $overdueTasks = Task::withOverdue()->get();

        return view('livewire.dashboard', compact('todayTasks', 'overdueTasks'));
    }
} 