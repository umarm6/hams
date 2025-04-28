<?php

namespace App\Enums;

enum RolesEnum: string
{
    case ADMIN = 'admin';
    case DOCTOR = 'doctor';
    case PATIENTS = 'patients';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::DOCTOR => 'Doctor',
            static::PATIENTS => 'Patients',
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
                'view medical records',
                'edit medical records',
                'create medical records',
                'delete medical records',
                'view prescriptions',
                'edit prescriptions',
                'create prescriptions',
                'delete prescriptions',
            ],
            static::PATIENTS => [
                'view appointments',
                'edit appointments',
                'create appointments',
                'delete appointments',
                'view medical records',
                'view prescriptions',
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
                'view medical records',
                'edit medical records',
                'create medical records',
                'delete medical records',
                'view prescriptions',
                'edit prescriptions',
                'create prescriptions',
                'delete prescriptions',
            ],
        };
    }


}

