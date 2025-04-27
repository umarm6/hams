<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    protected $appends=[
        'full_name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function doctorInfo(): HasOne
    {
        return $this->hasOne(DoctorInfo::class);
    }

    public function doctorSchedules(): HasMany
    {
        return $this->hasMany(DoctorSchedules::class,'doctor_id');
    }

    public function doctorAppointments(): HasMany
    {
        return $this->hasMany(Appointments::class,'doctor_id');
    }
    public function PatientAppointments(): HasMany
    {
        return $this->hasMany(Appointments::class,'patient_ids');
    }

    public function getFullNameAttribute(){
        return "$this->first_name $this->last_name";
    }
}
