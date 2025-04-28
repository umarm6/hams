<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prescription extends Model
{
    /** @use HasFactory<\Database\Factories\PrescriptionFactory> */
    use HasFactory;

    protected $guarded = [];

    public function patients(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
