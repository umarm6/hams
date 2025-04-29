<?php

namespace Database\Factories;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescription>
 */
class PrescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'medication_name'   => $this->faker->word(),
            'dosage'            => $this->faker->randomElement(['5mg', '10mg', '1 tablet']),
            'frequency'         => $this->faker->randomElement(['Once a day', 'Twice a day', 'Every 6 hours']),
            'notes'             => $this->faker->sentence(),
            'prescribed_date'   => $this->faker->date(),
        ];
    }
}
