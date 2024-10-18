<?php

namespace App\Models;

use App\Enums\MonthfeeStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Monthlyfee extends Model
{
    /** @use HasFactory<\Database\Factories\MonthlyfeeFactory> */
    use HasFactory, HasUlids;

    protected $fillable = [
        'amount',
        'status',
        'paid_at',
        'month',
        'student_id',
        'monthlyfee_ref',
    ];

    public function casts(): array
    {
        return [
            'paid_at' => "datetime",
            'status'=>MonthfeeStatus::class
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function isOwn(string $id)
    {
        return $this->student->id == $id;
    }
}
