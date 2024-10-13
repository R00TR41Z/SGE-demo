<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
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
            'birthday'=>'date'
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

    public function scopehasEnroll(){
        return $this->enrollments()->where('enrolled_at', now()->year);
    }
}
