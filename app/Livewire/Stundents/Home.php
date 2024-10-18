<?php

namespace App\Livewire\Stundents;

use App\Enums\DefaultPassword;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.guest')]
class Home extends Component
{
    public string $studentRef;

    public function go(): void
    {
        $this->validate(
            [
                'studentRef' => "required|string|exists:students,ref",
            ],
            ["studentRef.exists" => "A referencia dada é invalido"]
        );

        $auth = Auth::guard('student')->attempt([
            'ref' => $this->studentRef,
            'password' => DefaultPassword::STUDENT->value
        ]);

        $this->redirect(route('students.dashboard'));
    }

    #[Title('Inicio')]
    public function render(): View
    {
        return view('livewire.stundents.home');
    }
}
