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

    public $fillable = [
        'name', 'ref', 'birthday'
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
}
