<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>

    <x-nav-link :href="route('students')" :active="request()->routeIs('students')">
        {{ __('Estudantes') }}
    </x-nav-link>

    <x-nav-link :href="route('enrollments')" :active="request()->routeIs('enrollments')">
        {{ __('Matriculas') }}
    </x-nav-link>

    <x-nav-link :href="route('monthlyfees')" :active="request()->routeIs('monthlyfees')">
        {{ __('Mensalidades') }}
    </x-nav-link>
    <x-nav-link :href="route('transactions')" :active="request()->routeIs('transactions')">
        {{ __('Transações') }}
    </x-nav-link>
</div>