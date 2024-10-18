<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\Monthlyfee;
use App\Models\Enrollment;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use TallStackUi\Traits\Interactions;
use Illuminate\Pagination\LengthAwarePaginator;

#[Layout('layouts.app')]
class MonthlyFees extends Component
{
    use Interactions, WithPagination;


    #[Computed()]
    public function headers(): array
    {
        return [
            ['index'=>'monthlyfee_ref', 'label'=>'Referencia'],
            ['index'=>'student.name', 'label'=>'Nome completo'],
            ['index'=>'amount', 'label'=>'Montante'],
            ['index'=>'status.value', 'label'=>'Estado de pagamento'],
            ['index'=>'created_at', 'label'=>'Data de cobrança'],
            ['index'=>'paid_at', 'label'=>'Data de pagamento'],
        ];
    }

    #[Computed()]
    public function rows(): LengthAwarePaginator
    {
        return Monthlyfee::query()->paginate();
    }


    public function collectMonthlyfee(): void
    {
        $enrollements = Enrollment::with('student')->where('enrolled_at', now()->year)->get();

        $enrollements->each(function(Enrollment $enroll){

            try {
                $month_check = Monthlyfee::where('month', now()->format('Y-m'))
                ->where('student_id', $enroll->student->id);
    
                if(!$month_check->exists()){
                    $enroll->student->monthlyfees()->create([
                        'amount'=>500,
                        'month'=>now()->format('Y-m'),
                        'monthlyfee_ref'=>generateMonthlyfeeRef(),
                    ]);
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        });
       
    }



    #[Title('Mensalidades')]
    public function render(): View
    {
        return view('livewire.monthly-fees');
    }
}
