@props([
    'expanded' => true,
])
<ul class="font-medium flex flex-col items-center gap-8 text-center w-full lg:items-start" role="list">
    <x-sidebar.link href="{{ route('profile') }}" icon="profile" label="Profile" :expanded="$expanded"/>
    <li class="">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </li>
</ul>

