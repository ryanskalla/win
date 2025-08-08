<div class="flex h-full flex-col">
    <!-- Header -->
    <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 px-6 py-4">
        <flux:heading size="lg">Create New Task</flux:heading>
        <flux:button color="gray" variant="ghost" @click="$dispatch('close-sidebar')" wire:click="$dispatch('close-sidebar')">
            <flux:icon name="x" class="h-5 w-5" />
        </flux:button>
    </div>
    
    <!-- Content -->
    <div class="flex-1 overflow-y-auto p-6">
        @if (session()->has('message'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('message') }}
            </div>
        @endif
        <div class="space-y-6" x-data="{ 
            formData: {
                type: $wire.type,
                quadrant: $wire.quadrant,
                description: $wire.description,
                start_at: $wire.start_at,
                end_at: $wire.end_at,
                notes: $wire.notes
            }
        }" x-init="
            $watch('formData', (value) => {
                $wire.type = value.type;
                $wire.quadrant = value.quadrant;
                $wire.description = value.description;
                $wire.start_at = value.start_at;
                $wire.end_at = value.end_at;
                $wire.notes = value.notes;
            }, { deep: true })
        ">
            <div>
                <flux:radio.group variant="buttons" class="w-full *:flex-1" label="Action Type" name="type" x-model="formData.type">
                    @foreach(App\Enums\TaskType::cases() as $type)
                        <flux:radio icon="{{ $type->icon() }}" value="{{ $type->value }}" color="{{ $type->color() }}">{{ $type->label() }}</flux:radio>
                    @endforeach
                </flux:radio.group>
                @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <flux:label for="description">Description</flux:label>
                <flux:input id="description" type="text" placeholder="Enter task description" x-model="formData.description" required />
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            
            
            <div>
                <flux:radio.group variant="buttons" label="Quadrant" name="quadrant" x-model="formData.quadrant" class="flex flex-col space-y-2">
                    @foreach(App\Enums\Quadrant::cases() as $quadrant)
                        <flux:radio icon="{{ $quadrant->icon() }}" value="{{ $quadrant->value }}" color="{{ $quadrant->color() }}">{{ $quadrant->label() }}</flux:radio>
                    @endforeach
                </flux:radio.group>
                @error('quadrant') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <flux:label for="start_at">Start Time</flux:label>
                    <flux:input id="start_at" type="time" x-model="formData.start_at" @change="
                        if (formData.start_at && !formData.end_at) {
                            const start = new Date(`2000-01-01T${formData.start_at}`);
                            const end = new Date(start.getTime() + (60 * 60 * 1000)); // Add 1 hour
                            formData.end_at = end.toTimeString().slice(0, 5);
                        }
                    " />
                    @error('start_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <flux:label for="end_at">End Time</flux:label>
                    <flux:input id="end_at" type="time" x-model="formData.end_at" />
                    @error('end_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <div>
                <flux:label for="notes">Notes</flux:label>
                <flux:textarea id="notes" rows="3" placeholder="Additional notes..." x-model="formData.notes"></flux:textarea>
                @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="border-t border-gray-200 dark:border-gray-700 px-6 py-4">
        <div class="flex gap-3">
            <flux:button color="gray" variant="ghost" @click="$dispatch('close-sidebar')" wire:click="$dispatch('close-sidebar')" class="flex-1">
                Cancel
            </flux:button>
            <flux:button color="blue" class="flex-1" wire:click="createTask" wire:loading.attr="disabled">
                <span wire:loading.remove>Create Task</span>
                <span wire:loading>Creating...</span>
            </flux:button>
        </div>
    </div>
</div> 