<?php

namespace App\Livewire;

use App\Enums\MonthfeeStatus;
use App\Models\Enrollment;
use App\Models\Monthlyfee;
use App\Models\Student;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
class Dashboard extends Component
{


    #[Computed()]
    public function students(): int
    {
        return Student::count();
    }

    #[Computed()]
    public function enrollments(): int
    {
        return Enrollment::count();
    }


    #[Computed()]
    public function monthlyfees(): int
    {
        return Monthlyfee::count();
    }

    #[Computed()]
    public function paidMonthlyfees(): int
    {
        return Monthlyfee::query()->where('status', MonthfeeStatus::PAID->value)->count();
    }

    #[Computed()]
    public function unpaidMonthlyfees(): int
    {
        return Monthlyfee::query()->where('status', MonthfeeStatus::UNPAID->value)->count();
    }



    #[Title('Dashboard')]
    public function render(): View
    {
        return view('livewire.dashboard');
    }
}
