<?php

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

if (!function_exists('user')) {
    function user(): User
    {
        return Auth::user();
    }
}

if (!function_exists('generateStudentRef')) {
    function generateStudentRef(): string
    {
        do {
            $ref = strtoupper('est-' . substr(bin2hex(random_bytes(6)), 0, 6)) . '/' . now()->year;
        } while (Student::query()->where('ref', $ref)->exists());

        return $ref;
    }
}
