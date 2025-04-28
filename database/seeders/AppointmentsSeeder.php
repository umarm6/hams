<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\Appointments;
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

class AppointmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Appointments::factory(15)->create();

    }


}
