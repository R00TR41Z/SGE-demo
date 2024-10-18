<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('students.dashboard')" :active="request()->routeIs('students.dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>
</div>