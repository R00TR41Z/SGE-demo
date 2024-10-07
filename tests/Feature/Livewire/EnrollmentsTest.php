<?php

use App\Livewire\Enrollments;
use App\Models\Enrollment;
use App\Models\Student;
use Livewire\Livewire;

use function PHPUnit\Framework\assertEquals;

it('renders successfully', function () {
    Livewire::test(Enrollments::class)
        ->assertStatus(200);
});

it('can enroll student', function () {
    $student = Student::factory()->create();

    assertEquals(0, Enrollment::count());

    Livewire::test(Enrollments::class)
    ->set('student', $student->id)
    ->set('degree', '7 Classe')
    ->call('registerNewEnroll');

    assertEquals(1, Enrollment::count());
});
