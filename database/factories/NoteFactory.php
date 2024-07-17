<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'recipient' => fake()->safeEmail(),
            'title' => fake()->bs(),
            'content' => fake()->sentence(),
            'send_date' => now()->toDateString(),
            'is_published' => fake()->boolean(75),
        ];
    }
}
