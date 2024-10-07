<?php

use App\Livewire\Students;
use App\Models\Student;
use App\Models\User;
use Livewire\Livewire;

use function PHPUnit\Framework\assertEquals;

it('renders successfully', function () {
    Livewire::test(Students::class)
        ->assertStatus(200);
});

it('Can register new students', function () {

    assertEquals(0, Student::count());

    Livewire::test(Students::class)
        ->set('stuName', 'RootRaiz')
        ->set('stuBirthDay', '2004-08-14')
        ->call('registerNewStudent');

    assertEquals(1, Student::count());
});
