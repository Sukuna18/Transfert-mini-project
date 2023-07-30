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
            'fournisseur' => $this->faker->randomElement(['Wari', 'OrangeMoney', 'Wave', 'CarteBancaire']),
            'montant' => $this->faker->numberBetween(1000, 100000),
            'numero_compte' => function (array $attributes) {
                $fournisseur = $attributes['fournisseur'];
                $numero_compte = $this->faker->unique()->numberBetween(1000000000, 9999999999);
        
                switch ($fournisseur) {
                    case 'OrangeMoney':
                        $numero_compte = 'OM_' . str_pad($numero_compte, 8, '0', STR_PAD_LEFT);
                        break;
                    case 'Wari':
                        $numero_compte = 'WR_' . str_pad($numero_compte, 8, '0', STR_PAD_LEFT);
                        break;
                    case 'Wave':
                        $numero_compte = 'WV_' . str_pad($numero_compte, 8, '0', STR_PAD_LEFT);
                        break;
                    case 'CarteBancaire':
                        $numero_compte = 'CB_' . str_pad($numero_compte, 8, '0', STR_PAD_LEFT);
                        break;
                    default:
                        $numero_compte = 'AUTRE_' . str_pad($numero_compte, 8, '0', STR_PAD_LEFT);
                        break;
                }
        
                return $numero_compte;
            },
            'client_id' => \App\Models\Client::factory(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
