<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    #[Title('Dashboard')]
    public function render(): View
    {
        return view('livewire.dashboard');
    }
}
