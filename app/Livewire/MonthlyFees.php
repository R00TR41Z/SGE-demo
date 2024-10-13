<?php

namespace App\Livewire;

use App\Models\Enrollment;
use App\Models\Monthlyfee;
use App\Models\Student;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Illuminate\View\View;
use Karson\MpesaPhpSdk\Mpesa;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

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
        // $mpesaInstance = new Mpesa();
        // $mpesaInstance->setPublicKey(config('mpesa.public_key'));
        // $mpesaInstance->setApiKey(config('mpesa.api_key')); //test
        // $mpesaInstance->setEnv(config('mpesa.env'));
        // $mpesaInstance->setServiceProviderCode(config('mpesa.service_provider_code'));

        // dd($mpesaInstance->c2b("EST93Q432123", "258847049818", 500, "PAY4SF871".rand(100,1000)), mb_scrub('ola'));
    }



    #[Title('Mensalidades')]
    public function render(): View
    {
        return view('livewire.monthly-fees');
    }
}
