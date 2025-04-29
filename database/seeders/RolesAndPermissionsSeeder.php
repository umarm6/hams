<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\DoctorInfo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createRolesAndPermissions();
        $this->createUsersByRole();

    }



    private function createRolesAndPermissions():void{

        //truncating the tables
        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('roles')->truncate();
        Schema::enableForeignKeyConstraints();


        foreach (RolesEnum::cases() as $roles ) {

            $role = Role::findOrCreate($roles->value);

            foreach ($roles->permissions() as $permission) {
                 Permission::findOrCreate($permission);
            }
             $role->givePermissionTo($roles->permissions());
        }
    }

    private function createUsersByRole():void{

        foreach (RolesEnum::cases() as $roles ) {
            $email = $roles->value.'@gmail.com';
             if ($roles->value === RolesEnum::ADMIN->value) {

                if (!User::whereEmail($email)->exists()) {

                   User::factory(1)->create([
                        'email' => $email,
                        'password' => Hash::make('password'),
                    ])->each(function ($user) {
                            $user->assignRole(RolesEnum::ADMIN->value);
                    });
                }
            }

            if ($roles->value === RolesEnum::DOCTOR->value) {

                if (!User::whereEmail($email)->exists()) {

                    User::factory(1)->create([
                        'email' => $email,
                        'password' => Hash::make('password'),
                    ])->each(function ($user) {
                        $user->assignRole(RolesEnum::DOCTOR->value);
                        if ($user->hasRole(RolesEnum::DOCTOR->value)) {
                            DoctorInfo::factory(1)->create([
                                'user_id' => $user->id,
                            ]);
                        }

                    });;

                }
            }

            if ($roles->value === RolesEnum::PATIENTS->value) {

                if (!User::whereEmail($email)->exists()) {

                    User::factory(1)->create([
                        'email' => $email,
                        'password' => Hash::make('password'),
                    ])->each(function ($user) {
                        $user->assignRole(RolesEnum::PATIENTS->value);
                    });;

                }
            }

        }
    }
}
