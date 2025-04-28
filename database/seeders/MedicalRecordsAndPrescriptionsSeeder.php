<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\DoctorInfo;
use App\Models\DoctorSchedules;
use App\Models\MedicalRecord;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class MedicalRecordsAndPrescriptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createMedicalRecords();
        $this->createPrescription();

    }



    private function createMedicalRecords():void{

          MedicalRecord::factory(20)->create([
              'patient_id' => fake()->randomElement(User::role(RolesEnum::PATIENTS)->pluck('id')->toArray()),
              'doctor_id' => fake()->randomElement(User::role(RolesEnum::DOCTOR)->pluck('id')->toArray()),
          ]);
    }

    private function createPrescription():void{

       Prescription::factory(20)->create([
           'patient_id' => fake()->randomElement(User::role(RolesEnum::PATIENTS)->pluck('id')->toArray()),
           'doctor_id' => fake()->randomElement(User::role(RolesEnum::DOCTOR)->pluck('id')->toArray())
       ]);
    }
}
