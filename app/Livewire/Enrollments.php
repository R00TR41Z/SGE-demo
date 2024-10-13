<?php

namespace App\Livewire;

use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

#[Layout('layouts.app')]
class Enrollments extends Component
{
    use WithPagination, Interactions;

    public bool $newEnrollModal = false;

    public string $student;

    public string $degree;

    public int $quantity = 10;

    public array $degrees = [
        '1 Classe', '2 Classe', '3 Classe', '4 Classe',
        '5 Classe', '6 Classe', '7 Classe', '8 Classe',
        '9 Classe', '10 Classe', '11 Classe', '12 Classe',
    ];

    #[Computed()]
    public function headers(): array
    {
        return [
            ['index' => 'student.name', 'label' => 'Nome do aluno'],
            ['index' => 'student.ref', 'label' => 'Referencia do aluno'],
            ['index' => 'degree', 'label' => 'Classe'],
            ['index' => 'created_at', 'label' => 'Data de matricula'],
        ];
    }

    #[Computed()]
    public function enrollments(): LengthAwarePaginator
    {
        return Enrollment::orderBy('created_at', 'desc')
            ->paginate($this->quantity);
    }

    #[Computed()]
    public function students(): array
    {
        $students = [];

        foreach (Student::get(['name', 'id']) as $student) {
            array_push($students, [
                'label' => $student->name,
                'value' => $student->id,
            ]);
        }

        return $students;
    }


    public function registerNewEnroll(): mixed
    {
        $this->validate([
            'student' => ['required', 'string', Rule::exists('students', 'id')],
            'degree' => ['required', 'string', Rule::in($this->degrees)],
        ]);

        try {
            $student = Student::find($this->student);

            $student->enrollments()->create([
                'degree' => $this->degree,
                'enrolled_at'=>now()->year
            ]);
        } catch (\Throwable $th) {
            // throw $th;
            return $this->dialog()
                ->error('Erro', 'Ocorreu um falha interna, por favor tente novamente ou contacte ao suporte')
                ->send();
        }

        $this->reset([
            'student',
            'degree',
        ]);
        $this->newEnrollModal = false;

        return $this->dialog()->success('Pronto','Matricula feita')->send();
    }





    #[Title('Matriculas')]
    public function render(): View
    {
        return view('livewire.enrollments');
    }
}
