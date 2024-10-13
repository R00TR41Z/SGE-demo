<?php

use App\Models\Monthlyfee;
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


if (!function_exists('generateMonthlyfeeRef')) {
    function generateMonthlyfeeRef(): string
    {
        do {
            $ref = strtoupper('pgt' . substr(bin2hex(random_bytes(6)), 0, 9));
        } while (Monthlyfee::query()->where('monthlyfee_ref', $ref)->exists());

        return $ref;
    }
}
