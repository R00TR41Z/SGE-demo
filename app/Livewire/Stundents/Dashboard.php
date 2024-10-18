<?php

namespace App\Livewire\Stundents;

use App\Enums\MonthfeeStatus;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Monthlyfee;
use Livewire\WithPagination;
use Karson\MpesaPhpSdk\Mpesa;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use TallStackUi\Traits\Interactions;
use App\Exceptions\MonthlyfeeExecption;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

#[Layout('layouts.students.app')]
class Dashboard extends Component
{
    use Interactions, WithPagination;

    public string $customerNumber;

    public bool $modal = false;

    public string $monthlyfeeId;

    #[Computed()]
    public function headers(): array
    {
        return [
            ['index' => "monthlyfee_ref", 'label' => "Referencia"],
            ['index' => "amount", 'label' => "Montante"],
            ['index' => "status", 'label' => "Estado"],
            ['index' => "created_at", 'label' => "Data da cobrança"],
            ['index' => 'paid_at', 'label' => 'Data de pagamento'],
            ['index' => "action", 'label' => "Opções"],
        ];
    }

    #[Computed()]
    public function rows(): LengthAwarePaginator
    {
        return student()
            ->monthlyfees()
            ->paginate();
    }

    public function payMonthlyfee(string $monthlyfeeId)
    {
        $this->monthlyfeeId = $monthlyfeeId;
        $this->modal = true;
    }

    public function finishPayment(): mixed
    {
        try {

            $monthlyfee = Monthlyfee::query()
                ->find($this->monthlyfeeId, ['monthlyfee_ref', 'amount', 'id', 'student_id']);


            if (!$monthlyfee->isOwn(id: student()->id)) {
                throw new MonthlyfeeExecption;
            }

            $mpesaInstance = new Mpesa();
            $mpesaInstance->setPublicKey(config('mpesa.public_key'));
            $mpesaInstance->setApiKey(config('mpesa.api_key'));
            $mpesaInstance->setEnv(config('mpesa.env'));
            $mpesaInstance->setServiceProviderCode(config('mpesa.service_provider_code'));

            $response = $mpesaInstance->c2b(
                transactionReference: $monthlyfee->monthlyfee_ref,
                customerMSISDN: "258" . $this->customerNumber,
                amount: $monthlyfee->amount,
                thirdPartReferece: $monthlyfee->monthlyfee_ref
            )->response;

            if (!$response->output_ResponseCode == 'INS-0') {
                throw new \Exception('Something wont wrong requisting payment: ' . json_encode($response));
            }

            $monthlyfee->update([
                'status' => MonthfeeStatus::PAID->value,
                'paid_at'=> now()
            ]);
        } catch (\Throwable $th) {
            // throw $th;
            $this->modal = false;
            return $this->dialog()
                ->error('Erro', 'Ocorreu uma falha interna, por favor tente novament ou contacte ao suporte')
                ->send();
        }


        $this->reset('customerNumber', 'monthlyfeeId');
        $this->modal = false;
        unset($monthlyfee);

        return $this->dialog()->success("Pronto", "Mensalidade paga com sucesso")->send();
    }







    #[Title('Area do estudante')]
    public function render(): View
    {
        return view('livewire.stundents.dashboard');
    }
}
