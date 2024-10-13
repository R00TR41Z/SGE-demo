<?php

use App\Livewire\Transactions;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Transactions::class)
        ->assertStatus(200);
});
