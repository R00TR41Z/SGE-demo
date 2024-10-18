<div class="p-6">
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="flex flex-col md:grid md:grid-cols-3 gap-4 mb-4">
        <div class="mb-3">
            <x-ts-stats title="Matriculas" icon="book-open" color="blue" :number="student()->enrollments->count()"
                light animated/>
        </div>
        <div class="mb-3">
            <x-ts-stats title="Mensalidades pagas" icon="check-badge" color="green" light
                :number="student()->paidMonthlyfee()" animated/>
        </div>
        <div class="mb-3">
            <x-ts-stats title="Mensalidades Pendentes" :number="student()->unpaidMonthlyfee()" animated>
                <x-slot:right>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 fill-yellow-500" viewBox="0 0 256 256">
                        <path
                            d="M184,89.57V84c0-25.08-37.83-44-88-44S8,58.92,8,84v40c0,20.89,26.25,37.49,64,42.46V172c0,25.08,37.83,44,88,44s88-18.92,88-44V132C248,111.3,222.58,94.68,184,89.57ZM232,132c0,13.22-30.79,28-72,28-3.73,0-7.43-.13-11.08-.37C170.49,151.77,184,139,184,124V105.74C213.87,110.19,232,122.27,232,132ZM72,150.25V126.46A183.74,183.74,0,0,0,96,128a183.74,183.74,0,0,0,24-1.54v23.79A163,163,0,0,1,96,152,163,163,0,0,1,72,150.25Zm96-40.32V124c0,8.39-12.41,17.4-32,22.87V123.5C148.91,120.37,159.84,115.71,168,109.93ZM96,56c41.21,0,72,14.78,72,28s-30.79,28-72,28S24,97.22,24,84,54.79,56,96,56ZM24,124V109.93c8.16,5.78,19.09,10.44,32,13.57v23.37C36.41,141.4,24,132.39,24,124Zm64,48v-4.17c2.63.1,5.29.17,8,.17,3.88,0,7.67-.13,11.39-.35A121.92,121.92,0,0,0,120,171.41v23.46C100.41,189.4,88,180.39,88,172Zm48,26.25V174.4a179.48,179.48,0,0,0,24,1.6,183.74,183.74,0,0,0,24-1.54v23.79a165.45,165.45,0,0,1-48,0Zm64-3.38V171.5c12.91-3.13,23.84-7.79,32-13.57V172C232,180.39,219.59,189.4,200,194.87Z">
                        </path>
                    </svg>
                </x-slot:right>
            </x-ts-stats>
        </div>
    </div>

    <div>
        <h3 class="mb-3 text-2xl dark:text-gray-200">Mensalidades</h3>
        <x-ts-table :headers="$this->headers()" :rows="$this->rows()" paginate>
            @interact('column_status', $row)
            @if ($row->status->value == App\Enums\MonthfeeStatus::UNPAID->value)
            <x-ts-badge :text="$row->status->value" color="yellow" round light />
            @else
            <x-ts-badge :text="$row->status->value" color="green" round light />
            @endif
            @endinteract

            @interact('column_paid_at', $row)
            <p>{{ $row->paid_at?->format('d/m/Y H:i:s') ?? "Nenhuma" }}</p>
            @endinteract

            @interact('column_created_at', $row)
            <p>{{ $row->created_at->format('d/m/Y H:i:s') }}</p>
            @endinteract

            @interact('column_action', $row)
            @if ($row->status->value == App\Enums\MonthfeeStatus::UNPAID->value)
            <x-ts-button.circle icon="check" title="Pagar a mensalidade" color="green"
                wire:click="payMonthlyfee('{{ $row->id }}')" light flat />
            @endif
            @endinteract
        </x-ts-table>
    </div>

    <x-ts-modal wire center size="md">
        <form wire:submit.prevent="finishPayment">
            <div class="m-3">
                <div class="mb-2">
                    <x-ts-input wire:model="customerNumber" label="Numero" prefix="+258"
                        hint="Digite o numero que sera usado no pagamento" />
                </div>

                <div class="w-full">
                    <x-ts-button class="w-full" text="Finalizar" type="submit" />
                </div>
            </div>
        </form>
    </x-ts-modal>
</div>