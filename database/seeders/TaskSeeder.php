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
        Task::factory()->count(3)->create();
        Task::factory()->count(3)->completed()->create();
        Task::factory()->count(3)->scheduled()->create();
        Task::factory()->count(3)->urgentAndImportant()->create();
        Task::factory()->count(3)->notUrgentButImportant()->create();
        Task::factory()->count(3)->urgentButNotImportant()->create();
        Task::factory()->count(3)->notUrgentAndNotImportant()->create();
        Task::factory()->count(3)->call()->create();
        Task::factory()->count(3)->do()->create();
        Task::factory()->count(3)->go()->create();
    }
}
