<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <form wire:submit.prevent="go">
        <div class="mb-3">
            <x-ts-input wire:model="studentRef" label="Referencia do aluno" hint="Por favor insira a referencia do aluno" />
        </div>
        <div>
            <x-ts-button type="submit" text="Acessar" />
        </div>
    </form>
</div>