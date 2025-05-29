@props(['title' => ''])
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('components.partials.head')

<body class="font-sans bg-mywhite">
    @include('components.partials.header')
    <main x-data
      class="px-4 mt-22 flex-1 max-lg:!ml-0 transition-all duration-300 bg-mywhite min-h-[100vh] lg:mt-12"
      @sidebar-toggled.window="$el.style.marginLeft = $event.detail.expanded ? '16rem' : '5rem'"
      style="margin-left: {{ session('sidebar_expanded', true) ? '16rem' : '5rem' }};"
>
    <x-main-title>{{$title}}</x-main-title>
    {{ $slot }}
    </main>
@livewireScripts
</body>
</html>
