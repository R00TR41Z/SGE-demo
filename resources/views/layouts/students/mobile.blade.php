<div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('students.dashboard')" :active="request()->routeIs('students.dashboard')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
</div>