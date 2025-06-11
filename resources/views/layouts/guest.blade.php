@props(['title' => '', 'header' => ''])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('components.partials.head')
<body class="font-sans bg-mywhite  ">
<main class="flex flex-col lg:grid grid-cols-3 min-h-screen bg-mywhite">
    <h1 class="hidden">{{ $title ?? 'Auth' }}</h1>
    <section class="py-0 px-11 col-span-1 bg-sand flex justify-center lg:p-8">
        <h2 class="hidden">App Logo</h2>
        <x-app-logo-light />
    </section>
    <section class="p-15 gap-8 col-span-2 flex flex-col justify-between mx-auto lg:my-auto lg:gap-16 bg-mywhite">
        <h2 class="uppercase text-m text-center lg:text-xl text-turquoise">
            {{ $header }}
        </h2>
        {{ $slot }}
    </section>
</main>
@livewireScripts
</body>
</html>
