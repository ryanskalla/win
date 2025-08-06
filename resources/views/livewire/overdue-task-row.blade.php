<flux:table.row>
    <flux:table.cell>
        {{ $task->created_at->format('D, M j') }}
    </flux:table.cell>
    <flux:table.cell>
        <input type="checkbox" 
               wire:click="toggleCompletion"
               @if($this->isCompleted()) checked @endif
               class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800">
    </flux:table.cell>
    <flux:table.cell>
        <flux:badge icon="{{ $task->typeIcon() }}" color="{{ $task->typeColor() }}" size="sm" inset="top bottom">
            {{ $task->typeLabel() }}
        </flux:badge>
    </flux:table.cell>
    <flux:table.cell variant="strong" class="{{ $this->isCompleted() ? 'line-through text-gray-500 dark:text-gray-400' : '' }}">{{ $task->description }}</flux:table.cell>
    <flux:table.cell>
        <flux:badge icon="{{ $task->quadrantIcon() }}" color="{{ $task->quadrantColor() }}" size="sm" inset="top bottom">
            {{ $task->quadrantAction() }}
        </flux:badge>
    </flux:table.cell>
</flux:table.row> 