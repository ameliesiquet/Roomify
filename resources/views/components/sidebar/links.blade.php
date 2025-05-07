@props([
    'expanded' => true,
])

<ul role="list"  class="flex flex-col gap-8 items-center lg:items-start">
    <x-sidebar.link href="{{ route('dashboard') }}" icon="home" label="Dashboard" :expanded="$expanded" />
    <x-sidebar.link href="{{ route('shopping') }}" icon="shopping" label="Shopping" :expanded="$expanded" />
    <x-sidebar.link href="{{ route('rooms') }}" icon="rooms" label="Rooms" :expanded="$expanded" />
    <x-sidebar.link href="{{ route('items') }}" icon="lamp" label="Items" :expanded="$expanded" />
    <x-sidebar.link href="{{ route('budget') }}" icon="budget" label="Budget" :expanded="$expanded" />
</ul>
