<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\DoctorInfo;
use App\Models\DoctorSchedules;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DoctorsAndPatientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createDoctors();
        $this->createUPatients();

    }



    private function createDoctors():void{

         User::factory(5)->create()->each(function ($user) {

             $user->assignRole(RolesEnum::DOCTOR->value);

             DoctorInfo::factory()->create([
                 'user_id' => $user->id
             ]);

             DoctorSchedules::factory()->create([
                 'doctor_id' => $user->id
             ]);
         });
    }

    private function createUPatients():void{

        User::factory(5)->create()->each(function ($user) {
            $user->assignRole(RolesEnum::PATIENTS->value);
        });
    }
}
