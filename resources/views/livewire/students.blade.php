<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Estudantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between mb-3">
                        <h1 class="text-3xl">Lista dos estudantes</h1>
                        <x-ts-button icon="plus" text="Novo" wire:click="$toggle('newStudentModal')"/>
                    </div>
                    <x-ts-table :quantitys="[5, 10, 25, 50, 100]" paginate filter :rows="$this->students()"
                        :headers="$this->headers()">
                        @interact('column_birthday', $row)
                            <p>{{ $row->birthday->format('d/m/Y') }}</p>
                        @endinteract

                        @interact('column_age', $row)
                            <p>{{ $row->birthday->age }}</p>
                        @endinteract
                    </x-ts-table>
                </div>
            </div>
        </div>
    </div>


    <x-ts-modal wire="newStudentModal" title="Novo estudante" center blur persist size="md">
        <form wire:submit.prevent="registerNewStudent">
            <div class="mb-3">
                <x-ts-input wire:model="stuName" label="Nome completo *" />
            </div>
            <div class="mb-3">
                <x-ts-date :min-year="2000" :max-year="2019" wire:model="stuBirthDay" label="Data de nascimento *" />
            </div>
            <div class="mb-3">
                <x-ts-button type="submit" text="Finalizar" icon="bookmark-square" loading/>
            </div>
        </form>
    </x-ts-modal>
</div>