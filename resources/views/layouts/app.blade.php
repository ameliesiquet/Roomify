<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')

<body class="font-sans  antialiased">
<div class="min-h-screen bg-sand">
    <livewire:layout.navigation/>
    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    {{-- MAIN --}}
    <main class="p-4">
        <p>Hallo (app.blade)</p>
        {{ $slot }}
    </main>
    @livewireScripts
</div>
</body>
</html>
