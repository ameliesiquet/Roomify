<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body class="font-sans bg-mywhite" >
<header>
    <h1 role="heading" aria-level="1" class="sr-only">{{ $title ?? 'Default title' }}</h1>
    {{ $banner ?? null }}
    <livewire:sidebar/>
</header>



<main
        x-data
        class="flex-1 max-lg:!ml-0 transition-all duration-300 bg-mywhite"
        @sidebar-toggled.window="$el.style.marginLeft = $event.detail.expanded ? '16rem' : '5rem'"
        style="margin-left: {{ session('sidebar_expanded', true) ? '16rem' : '5rem' }};"
>
    <div class="p-4">
        {{ $slot }}
    </div>
</main>

@livewireScripts
</body>
</html>
