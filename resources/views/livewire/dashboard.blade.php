<div>
    <x-layouts.app :title="__('Dashboard')">
        <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
            <div class="relative w-full overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <flux:heading size="xl">
                    {{ \Carbon\Carbon::now()->translatedFormat('l, F j, Y') }}
                </flux:heading>
                <div class="absolute bottom-4 left-4 text-3xl font-bold text-gray-900 dark:text-neutral-100">
                    Q{{ now()->quarter }} | {{ floor(now()->diffInDays(now()->endOfYear())) }} days | {{ Number::format(floor(now()->diffInHours(now()->endOfYear()))) }} hours 
                </div>
            </div>
            <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700" 
                 x-data="{ sidebarOpen: false }"
                 @keydown.cmd.c.window="sidebarOpen = true"
                 @keydown.ctrl.c.window="sidebarOpen = true"
                 @keydown.escape.window="sidebarOpen = false"
                 @close-sidebar.window="sidebarOpen = false"
                 @task-created.window="sidebarOpen = false; $wire.$refresh()"
                 @task-completion-toggled.window="$wire.$refresh()">
                <div class="flex items-center justify-between p-4 border-b border-neutral-200 dark:border-neutral-700">
                    <flux:heading size="lg">Today's Tasks ({{ $todayTasks->count() }})</flux:heading>
                    <flux:button color="blue" @click="sidebarOpen = true">
                        <flux:icon name="plus" class="h-4 w-4" />
                        Create
                    </flux:button>
                </div>
                
                <flux:table>
                    <flux:table.columns>
                        <flux:table.column>Completed</flux:table.column>    
                        <flux:table.column>Action</flux:table.column>
                        <flux:table.column>Description</flux:table.column>
                        <flux:table.column>Time Block</flux:table.column>
                        <flux:table.column>Quadrant</flux:table.column>
                    </flux:table.columns>

                    <flux:table.rows>
                        @if($todayTasks->count() > 0)
                            @foreach($todayTasks as $todayTask)
                                <livewire:task-row :task="$todayTask" />
                            @endforeach
                        @else
                            <flux:table.row>
                                <flux:table.cell colspan="5" class="text-center py-8 text-gray-500 dark:text-gray-400">
                                    Tasks are empty
                                </flux:table.cell>
                            </flux:table.row>
                        @endif
                    </flux:table.rows>
                </flux:table>

                <!-- Right Sidebar -->
                <div x-show="sidebarOpen" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 z-50 overflow-hidden"
                     x-cloak>
                    
                    <!-- Backdrop -->
                    <div class="absolute inset-0 bg-black bg-opacity-50" @click="sidebarOpen = false"></div>
                    
                    <!-- Sidebar -->
                    <div class="absolute right-0 top-0 h-full w-full max-w-md bg-white dark:bg-gray-900 shadow-xl"
                         x-transition:enter="transform transition ease-in-out duration-300"
                         x-transition:enter-start="translate-x-full"
                         x-transition:enter-end="translate-x-0"
                         x-transition:leave="transform transition ease-in-out duration-300"
                         x-transition:leave-start="translate-x-0"
                         x-transition:leave-end="translate-x-full">
                        
                        <livewire:create-task-form />
                    </div>
                </div>
            </div>

            @if($overdueTasks->count() > 0)
            <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700" 
                 x-data="{ sidebarOpen: false }"
                 @task-completion-toggled.window="$wire.$refresh()">
                <div class="flex items-center justify-between p-4 border-b border-neutral-200 dark:border-neutral-700">
                        <flux:heading size="lg">Overdue Tasks ({{ $overdueTasks->count() }})</flux:heading>
                </div>
                
                <flux:table>
                    <flux:table.columns>
                        <flux:table.column>Created</flux:table.column>
                        <flux:table.column>Completed</flux:table.column>    
                        <flux:table.column>Action</flux:table.column>
                        <flux:table.column>Description</flux:table.column>
                        <flux:table.column>Quadrant</flux:table.column>
                    </flux:table.columns>

                    <flux:table.rows>
                            @foreach($overdueTasks as $overdueTask)
                                <livewire:overdue-task-row :task="$overdueTask" />
                            @endforeach
                        </flux:table.rows>
                    </flux:table>
                </div>
            @endif
        </div>
    </x-layouts.app>
</div> 