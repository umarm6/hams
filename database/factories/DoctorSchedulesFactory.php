<?php

namespace Database\Factories;

use App\Models\DoctorSchedules;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DoctorSchedulesFactory extends Factory
{
    protected $model = DoctorSchedules::class;

    public function definition(): array
    {
         return [
            'day' =>$this->faker->randomElement(['Monday','Tuesday','Wednesday','Thursday','Friday']),
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now()->addHours(8),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ];
    }
}
