<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::factory()->count(10)->create();
        Task::factory()->count(10)->completed()->create();
        Task::factory()->count(10)->scheduled()->create();
        Task::factory()->count(10)->urgentAndImportant()->create();
        Task::factory()->count(10)->notUrgentButImportant()->create();
        Task::factory()->count(10)->urgentButNotImportant()->create();
        Task::factory()->count(10)->notUrgentAndNotImportant()->create();
        Task::factory()->count(10)->call()->create();
        Task::factory()->count(10)->do()->create();
        Task::factory()->count(10)->go()->create();
    }
}
