<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
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
            'user_id' => fake()->numberBetween(1, 10),
            'title' => fake()->title(),
            'description' => fake()->title(),
            'status' => fake()->randomElement([
                'pending',
                'in_process',
                'blocked',
                'done',
                'deleted'
            ]),
            'start_date' => fake()->dateTime(),
            'end_date' => fake()->dateTime(),
        ];
    }
}
