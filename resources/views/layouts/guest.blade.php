<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body class="font-sans bg-mywhite  ">
<main class="px-4 mt-18 min-h-[100vh] bg-mywhite lg:mt-8">
    <p>Hallo (guest.blade)</p>
    {{ $slot }}
</main>
@livewireScripts
</body>
</html>
