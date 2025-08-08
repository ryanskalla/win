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
        Task::factory()->count(3)->completed()->create();
        Task::factory()->count(3)->scheduled()->create();
        Task::factory()->count(2)->call()->create();
        Task::factory()->count(2)->call()->notUrgentButImportant()->create();
        Task::factory()->count(2)->call()->urgentButNotImportant()->create();
        Task::factory()->count(2)->call()->notUrgentAndNotImportant()->create();
        Task::factory()->count(2)->do()->create();
        Task::factory()->count(2)->do()->notUrgentButImportant()->create();
        Task::factory()->count(2)->do()->urgentButNotImportant()->create();
        Task::factory()->count(2)->do()->notUrgentAndNotImportant()->create();
        Task::factory()->count(2)->go()->create();
        Task::factory()->count(2)->go()->notUrgentButImportant()->create();
        Task::factory()->count(2)->go()->urgentButNotImportant()->create();
        Task::factory()->count(2)->go()->notUrgentAndNotImportant()->create();
        Task::factory()->count(3)->overdue()->create();
        Task::factory()->count(1)->overdue()->urgentButNotImportant()->create();
        Task::factory()->count(1)->overdue()->notUrgentButImportant()->create();
        Task::factory()->count(1)->overdue()->notUrgentAndNotImportant()->create();
    }
}
