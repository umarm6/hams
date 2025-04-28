<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorSchedules extends Model
{
    use HasFactory;
    //

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime:H:i',
            'end_time' => 'datetime:H:i',
        ];
    }
}
