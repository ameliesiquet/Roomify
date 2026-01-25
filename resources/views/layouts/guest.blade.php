@props(['title' => '', 'header' => ''])
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('components.partials.head')
<body class="font-sans bg-mywhite">
<main class="flex flex-col lg:grid lg:grid-cols-4 min-h-screen bg-mywhite">
    <h1 class="hidden">{{ $title ?? 'Auth' }}</h1>

    <section class="py-0 px-11 col-span-2 bg-sand flex flex-col items-center justify-center gap-8 lg:p-8">
        <h2 class="hidden">App Logo</h2>
        <x-app-logo-light />

        <div class="hidden w-full max-w-md lg:flex flex-col gap-6">
            <div class="rounded-lg overflow-hidden shadow-2xl">
                <img
                    src="{{ asset('images/rooms.png') }}"
                    alt="Roomify App Preview"
                    class="w-full h-auto"
                >
            </div>
            <div class="rounded-lg overflow-hidden shadow-2xl">
                <img
                    src="{{ asset('images/budget.png') }}"
                    alt="Roomify App Preview"
                    class="w-full h-auto"
                >
            </div>
        </div>
    </section>

    <section class="p-15 gap-2 col-span-2 flex flex-col lg:justify-center lg:gap-6 bg-mywhite lg:pl-12 lg:pr-16">
        <h2 class="uppercase text-m text-center lg:text-left lg:text-xl text-turquoise">
            {{ $header }}
        </h2>
        {{ $slot }}
    </section>
</main>
@livewireScripts
</body>
</html>
