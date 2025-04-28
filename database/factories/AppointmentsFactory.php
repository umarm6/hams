<?php

namespace Database\Factories;

use App\Enums\RolesEnum;
use App\Models\Appointments;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AppointmentsFactory extends Factory
{
    protected $model = Appointments::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->word(),
            'mobile' => $this->faker->word(),
            'appointment_date' => Carbon::now(),
            'appointment_time' => Carbon::now(),
            'status' => $this->faker->randomElement(['pending','confirmed']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'doctor_id' => User::role(RolesEnum::DOCTOR->value)->inRandomOrder()->first(),
            'patient_id' => User::role(RolesEnum::PATIENTS->value)->inRandomOrder()->first(),
        ];
    }
}
