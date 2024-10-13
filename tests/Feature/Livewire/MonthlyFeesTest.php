<?php

use App\Livewire\MonthlyFees;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(MonthlyFees::class)
        ->assertStatus(200);
});
