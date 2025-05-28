@props([
    'expanded' => true,
])
<ul class="font-medium flex flex-col items-center gap-8 text-center w-full lg:items-start" role="list">
    <x-sidebar.link href="{{ route('profile') }}" icon="profile" label="Profile" :expanded="$expanded"/>
    <li class="">
        <x-button wire:click="logout" type="button">
            {{ __('Logout') }}
        </x-button>
    </li>
</ul>

