@props([
    'expanded' => true,
])


<ul class="font-medium custom-mt-auto" role="list">
    <x-sidebar.link href="{{ route('profile') }}" icon="profile" label="Profile" :expanded="$expanded" />

</ul>
