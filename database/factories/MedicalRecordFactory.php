<?php

namespace Database\Factories;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalRecord>
 */
class MedicalRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => User::factory()->create()->assignRole(RolesEnum::PATIENTS->value)->id,
            'doctor_id' => User::factory()->create()->assignRole(RolesEnum::DOCTOR->value)->id,
            'diagnosis' => $this->faker->sentence(3),
            'notes' => $this->faker->paragraph(),
            'record_date' => $this->faker->date(),
        ];
    }
}
