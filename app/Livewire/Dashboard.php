<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

final class Dashboard extends Component
{
    public function render()
    {
        $todayTasks = Task::withToday()->get();
        $overdueTasks = Task::withOverdue()->get();

        return view('livewire.dashboard', compact('todayTasks', 'overdueTasks'));
    }
} 