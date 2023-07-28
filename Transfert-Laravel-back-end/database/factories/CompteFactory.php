<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compte>
 */
class CompteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fournisseur' => $this->faker->unique()->randomElement(['Wari', 'OrangeMoney', 'Wave', 'CarteBancaire']),
            'montant' => $this->faker->numberBetween(1000, 100000),
            'numero_compte' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'client_id' => \App\Models\Client::factory(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
