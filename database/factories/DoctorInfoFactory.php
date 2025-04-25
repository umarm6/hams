<?php

namespace Database\Factories;

use App\Constants\Specialist;
use App\Models\DoctorInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorInfoFactory extends Factory
{
    protected $model = DoctorInfo::class;

    public function definition(): array
    {
        return [
            'doctor_fee' => fake()->randomElement([1000,1500,2000,2500]),
            'specialist' => fake()->randomElement(Specialist::data()),
            'description' => fake()->paragraph(),
            'qualification' => fake()->text(),
        ];
    }
}
