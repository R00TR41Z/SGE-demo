<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    /** @use HasFactory<\Database\Factories\EnrollmentFactory> */
    use HasFactory, HasUlids;

    public $fillable = [
        'degree',
        'student_id',
        'enrolled_at',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
