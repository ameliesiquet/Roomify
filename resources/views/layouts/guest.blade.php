<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body>
<main class="min-h-[100vh]">
    <p>Hallo (guest.blade)</p>
    {{ $slot }}
</main>
@livewireScripts
</body>
</html>
