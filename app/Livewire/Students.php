<?php

namespace App\Livewire;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

#[Layout('layouts.app')]
class Students extends Component
{
    use WithPagination, Interactions;
    public string $search = "";

    public int $quantity = 10;

    public $newStudentModal = false;

    public string $stuName;

    public string $stuBirthDay;

    #[Computed()]
    public function students(): LengthAwarePaginator
    {
        return Student::when($search = $this->search, function (Builder $query) use ($search) {
            return $query->where('name', 'like', "%$search%")->orWhere('ref', 'like', "%$search%");
        })->orderBy('created_at', 'desc')->paginate($this->quantity);
    }

    public function headers(): array
    {
        return [
            ['index' => 'ref', 'label' => 'Referencia'],
            ['index' => 'name', 'label' => 'Nome completo'],
            ['index' => 'age', 'label' => 'Idade'],
            ['index' => 'birthday', 'label' => 'Data de nascimento'],
        ];
    }

    public function registerNewStudent(): mixed
    {

        $this->validate([
            'stuName' => 'required|string|min:3|max:50',
            'stuBirthDay' => 'required|string|date'
        ]);

        try {
            Student::create([
                'name' => $this->stuName,
                'birthday' => $this->stuBirthDay,
                'ref' => generateStudentRef()
            ]);
        } catch (\Throwable $th) {
            // throw $th;
            $this->newStudentModal = false;
            return $this->dialog()
                ->error('Erro', 'Ocorreu um falha interna, por favor tente novamente ou contacte ao suporte')
                ->send();
        }

        $this->reset([
            'stuName',
            'stuBirthDay'
        ]);

        $this->newStudentModal = false;

        return $this->dialog()->success("Pronto", "Estudante registado")->send();
    }





    #[Title('Estudates')]
    public function render(): View
    {
        return view('livewire.students');
    }
}
