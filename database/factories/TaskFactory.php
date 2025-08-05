<?php

namespace Database\Factories;

use App\Enums\Quadrant;
use App\Enums\TaskType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => TaskType::Call,
            'description' => $this->faker->sentence,
            'quadrant' => Quadrant::UrgentAndImportant,
            'notes' => $this->faker->sentence,
            'completed_at' => null,
            'start_at' => null,
            'end_at' => null,
        ];
    }

    public function completed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'completed_at' => now(),
            ];
        });
    }

    public function scheduled(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'start_at' => now(),
                'end_at' => now()->addHours(1),
            ];
        });
    }

    public function urgentAndImportant(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'quadrant' => Quadrant::UrgentAndImportant,
            ];
        });
    }

    public function notUrgentButImportant(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'quadrant' => Quadrant::NotUrgentButImportant,
            ];
        });
    }

    public function urgentButNotImportant(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'quadrant' => Quadrant::UrgentButNotImportant,
            ];
        });
    }

    public function notUrgentAndNotImportant(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'quadrant' => Quadrant::NotUrgentAndNotImportant,
            ];
        });
    }

    public function call(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => TaskType::Call,
            ];
        });
    }

    public function do(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => TaskType::Do,
            ];
        });
    }

    public function go(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => TaskType::Go,
            ];
        });
    }

    public function notes(string $notes): Factory
    {
        return $this->state(function (array $attributes) use ($notes) {
            return [
                'notes' => $notes,
            ];
        });
    }

    public function description(string $description): Factory
    {
        return $this->state(function (array $attributes) use ($description) {
            return [
                'description' => $description,
            ];
        });
    }

    public function startAt(string $startAt): Factory
    {
        return $this->state(function (array $attributes) use ($startAt) {
            return [
                'start_at' => $startAt,
            ];
        });
    }

    public function endAt(string $endAt): Factory
    {
        return $this->state(function (array $attributes) use ($endAt) {
            return [
                'end_at' => $endAt,
            ];
        });
    }

    public function type(TaskType $type): Factory
    {
        return $this->state(function (array $attributes) use ($type) {
            return [
                'type' => $type,
            ];
        });
    }

    public function quadrant(Quadrant $quadrant): Factory
    {
        return $this->state(function (array $attributes) use ($quadrant) {
            return [
                'quadrant' => $quadrant,
            ];
        });
    }

    public function focus(string $focus): Factory
    {
        return $this->state(function (array $attributes) use ($focus) {
            return [
                'focus' => $focus,
            ];
        });
    }
}
