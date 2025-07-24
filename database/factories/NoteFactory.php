<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'public_id' => $this->faker->uuid,
            'title' => $this->faker->words(3, true),
            'content' => $this->faker->words(10, true),
            'author_id' => User::factory(),
            'is_public' => $this->faker->boolean(),
        ];
    }
}
