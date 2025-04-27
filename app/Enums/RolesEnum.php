<?php

namespace App\Enums;

enum RolesEnum: string
{
    case ADMIN = 'admin';
    case DOCTOR = 'doctor';
    case Patients = 'patients';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::DOCTOR => 'Doctor',
            static::Patients => 'Patients',
            static::ADMIN => 'Admin',
        };
    }

     public function permissions(): array
     {
        return match ($this) {
            static::DOCTOR => [
                'view dashboard',
                'view appointments',
                'create appointments',
                'delete appointments',
                'approveOrCancel appointments',
                'view ehr records',
                'create ehr records',
                'delete ehr records',
            ],
            static::Patients => [
                'view appointments',
                'edit appointments',
                'create appointments',
                'delete appointments',
            ],
            static::ADMIN => [
                'view dashboard',
                'create doctor',
                'edit doctor',
                'delete doctor',
                'view doctor',
                'create patients',
                'view patients',
                'edi patients',
                'delete patients',
                'view appointments',
                'edit appointments',
                'create appointments',
                'delete appointments',
                'approveOrCancel appointments',
                'view ehr records',
                'create ehr records',
                'delete ehr records',
            ],
        };
    }


}

