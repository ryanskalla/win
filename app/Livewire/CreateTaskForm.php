<?php

namespace App\Livewire;

use App\Enums\Quadrant;
use App\Enums\TaskType;
use App\Models\Task;
use Livewire\Component;

final class CreateTaskForm extends Component
{
    public string $type = 'do';
    public string $quadrant = 'not_urgent_but_important';
    public string $description = '';
    public string $start_at = '';
    public string $end_at = '';
    public string $notes = '';

    protected array $rules = [
        'type' => 'required|string',
        'quadrant' => 'required|string',
        'description' => 'required|string|max:255|regex:/\S/',
        'start_at' => 'nullable|date_format:H:i',
        'end_at' => 'nullable|date_format:H:i|after:start_at',
        'notes' => 'nullable|string|max:1000',
    ];

    protected array $messages = [
        'description.regex' => 'The description cannot be blank.',
    ];

    public function createTask(): void
    {
        $this->validate();

        Task::create([
            'type' => $this->type,
            'quadrant' => $this->quadrant,
            'description' => $this->description,
            'start_at' => $this->start_at ? now()->setTimeFromTimeString($this->start_at) : null,
            'end_at' => $this->end_at ? now()->setTimeFromTimeString($this->end_at) : null,
            'notes' => $this->notes,
        ]);

        $this->reset(['type', 'quadrant', 'description', 'start_at', 'end_at', 'notes']);
        
        $this->dispatch('task-created');
        session()->flash('message', 'Task created successfully!');
    }

    public function render()
    {
        return view('livewire.create-task-form');
    }
} 