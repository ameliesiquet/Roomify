<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('components.partials.head')

<body class="font-sans  antialiased bg-mywhite">
<div class="min-h-screen bg-sand">
    <header>
        <h1 role="heading" aria-level="1" class="sr-only">{{ $title ?? 'Default title' }}</h1>
        {{ $banner ?? null }}
        <livewire:sidebar/>
    </header>

    {{-- MAIN --}}
    <main class="px-4 mt-18 bg-mywhite min-h-[100vh] lg:mt-8">
        <p>Hallo (app.blade)</p>
        {{ $slot }}
    </main>
    @livewireScripts
</div>
</body>
</html>
