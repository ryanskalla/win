<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <flux:heading size="xl">
                    {{ __('Incomplete Tasks') }}
                </flux:heading>
                <div class="absolute bottom-4 left-4 text-3xl font-bold text-gray-900 dark:text-neutral-100">
                    {{ \App\Models\Task::withIncomplete()->count() }}
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <flux:heading size="xl">
                    {{ __('Today\'s Tasks') }}
                </flux:heading>
                <div class="absolute bottom-4 left-4 text-3xl font-bold text-gray-900 dark:text-neutral-100">
                    {{ \App\Models\Task::withToday()->count() }}
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <flux:heading size="xl">
                    {{ \Carbon\Carbon::now()->translatedFormat('l, F j, Y') }}
                </flux:heading>
                <div class="absolute bottom-4 left-4 text-3xl font-bold text-gray-900 dark:text-neutral-100">
                    Q{{ now()->quarter }} | {{ floor(now()->diffInDays(now()->endOfYear())) }} days | {{ Number::format(floor(now()->diffInHours(now()->endOfYear()))) }} hours 
                </div>
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
