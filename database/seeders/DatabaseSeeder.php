<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Dotanin',
            'email' => 'dotanin@dev.com',
        ]);

        $this->call(StudentSeeder::class);

        $student = Student::first();
        $student->enrollments()->create([
            'degree'=>'4 classe',
            'enrolled_at'=>now()->year
        ]);
    }
}
