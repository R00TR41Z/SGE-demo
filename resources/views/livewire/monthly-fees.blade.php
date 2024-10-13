<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mensalidades') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between mb-3">
                        <h1 class="text-3xl">Lista de Mensalidades</h1>
                        <x-ts-button text="Cobrar" wire:click="collectMonthlyfee"/>
                    </div>
                    <x-ts-table :rows="$this->rows()"
                        :headers="$this->headers()" paginate>
                        @interact('column_status.value', $row)
                        @if ($row->status->value == App\Enums\MonthfeeStatus::UNPAID->value)
                            <x-ts-badge :text="$row->status->value" color="yellow" round light />
                        @else
                            <x-ts-badge :text="$row->status->value" color="green" round light />
                        @endif
                        @endinteract

                        @interact('column_paid_at', $row)
                            <p>{{ $row->paid_at?->format('d/m/Y H:i:s') }}</p>
                        @endinteract

                        @interact('column_created_at', $row)
                            <p>{{ $row->created_at->format('d/m/Y H:i:s') }}</p>
                        @endinteract
                    </x-ts-table>
                </div>
            </div>
        </div>
    </div>
</div>