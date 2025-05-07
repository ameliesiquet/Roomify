@props([
    'expanded' => true,
])
<ul class="font-medium flex flex-col items-center gap-8 text-center w-full" role="list">
    <x-sidebar.link href="{{ route('profile') }}" icon="profile" label="Profile" :expanded="$expanded" />
    <li>
        <x-button>Logout</x-button>
    </li>
</ul>

