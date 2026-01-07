@props(['title' => ''])
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('components.partials.head')

<body class="font-sans bg-mywhite">
    @include('components.partials.header')

    <main
        x-data
        class="
        pl-10 pr-10
        lg:pr-20
        mt-22
        flex-1
        max-lg:!ml-0
        transition-all duration-300
        bg-mywhite
        min-h-[100vh]
        lg:mt-12
        flex flex-col gap-10
    "
        @sidebar-toggled.window="$el.style.marginLeft = $event.detail.expanded ? '16rem' : '5rem'"
        style="margin-left: {{ session('sidebar_expanded', true) ? '16rem' : '5rem' }};"
    >
    <x-texts.main-title>{{$title}}</x-texts.main-title>

    {{ $slot }}
    </main>
@livewireScripts
</body>
</html>
