<?php

namespace App\Models;

use App\Enums\MonthfeeStatus;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends User
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory, HasUlids;

    protected $fillable =
    [
        'name', 'ref', 'birthday'
    ];

    protected $with =
    [
        'enrollments'
    ];


    public function casts(): array
    {
        return [
            'birthday' => 'date',
            'password' => 'hashed'
        ];
    }


    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function monthlyfees(): HasMany
    {
        return $this->hasMany(Monthlyfee::class);
    }

    public function paidMonthlyfee(): int
    {
        return $this->monthlyfees()->where('status', MonthfeeStatus::PAID->value)->count();
    }

    public function unPaidMonthlyfee(): int
    {
        return $this->monthlyfees()->where('status', MonthfeeStatus::UNPAID->value)->count();
    }

    public function hasEnroll()
    {
        return $this->enrollments()->where('enrolled_at', now()->year);
    }
}
