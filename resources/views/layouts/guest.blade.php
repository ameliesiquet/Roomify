<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body class="font-sans bg-mywhite ">
<main class="min-h-[100vh] bg-mywhite">
    <p>Hallo (guest.blade)</p>
    {{ $slot }}
</main>
@livewireScripts
</body>
</html>
