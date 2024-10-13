<div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
    
        <x-responsive-nav-link :href="route('students')" :active="request()->routeIs('students')">
            {{ __('Estudantes') }}
        </x-responsive-nav-link>
    
        <x-responsive-nav-link :href="route('enrollments')" :active="request()->routeIs('enrollments')">
            {{ __('Matriculas') }}
        </x-responsive-nav-link>
    
        <x-responsive-nav-link :href="route('monthlyfees')" :active="request()->routeIs('monthlyfees')">
            {{ __('Mensalidades') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('transactions')" :active="request()->routeIs('transactions')">
            {{ __('Transações') }}
        </x-responsive-nav-link>
</div>