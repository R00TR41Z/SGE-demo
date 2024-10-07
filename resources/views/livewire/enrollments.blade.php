<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Matriculas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between mb-3">
                        <h1 class="text-3xl">Lista de matriculas</h1>
                        <x-ts-button icon="plus" text="Novo" wire:click="$toggle('newEnrollModal')"/>
                    </div>
                    <x-ts-table :quantitys="[5, 10, 25, 50, 100]" paginate :rows="$this->enrollments()"
                        :headers="$this->headers()">
                        {{-- @interact('column_birthday', $row)
                            <p>{{ $row->birthday->format('d/m/Y') }}</p>
                        @endinteract --}}
                    </x-ts-table>
                </div>
            </div>
        </div>
    </div>


    <x-ts-modal wire="newEnrollModal" title="Novo maricula" center blur persist size="md">
        <form wire:submit.prevent="registerNewEnroll">
            <div class="mb-3">
                <x-ts-select.styled searchable wire:model="student" :options="$this->students()" select="'label:label|value:value" label="Aluno"/>
            </div>
            <div class="mb-3">
                <x-ts-select.styled searchable wire:model="degree" :options="$degrees" label="Classe"/>
            </div>
            <div class="mb-3">
                <x-ts-button type="submit" text="Maricular" loading/>
            </div>
        </form>
    </x-ts-modal>
</div>
