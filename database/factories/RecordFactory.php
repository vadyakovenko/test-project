<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Record>
 */
class RecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(5), // Generate a random 5-word sentence
            'status' => $this->faker->randomElement(['In Stock', 'Out of Stock', 'Discontinued']), // Random status
            'notes' => $this->faker->sentence(8), // Generate a random 8-word sentence for notes
        ];
    }
}
