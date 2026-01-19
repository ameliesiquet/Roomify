<x-guest-layout class="flex flex-col justify-center">
    <h1 class="font-medium text-lg">Welcome to Roomify!</h1>
    <section class="flex flex-col items-baseline justify-center space-y-6">
        <h2 class="text-xl font-medium text-gray-900 mb-2 self-baseline">
            Plan your move with ease 🏠✨
        </h2>

        <p class="text-gray-700 text-sm leading-relaxed mb-4">
            Moving to a new place can be overwhelming 📦. Roomify helps you stay organized by letting you save furniture and decor items directly into specific rooms 🛋️, instead of losing track in endless favorites lists 🎯.
        </p>

        <ul class="space-y-6">
            <li>
                <h3 class="font-medium text-turquoise uppercase mb-1">
                    Organize by Room 🚪
                </h3>
                <p class="text-gray-600 text-sm">
                    Sort your furniture and decor items into different rooms for better overview
                </p>
            </li>

            <li>
                <h3 class="font-medium text-turquoise uppercase mb-1">
                    Track Your Budget 💰
                </h3>
                <p class="text-gray-600 text-sm">
                    Set a total budget and see exactly how much you've spent and what's left 💸
                </p>
            </li>

            <li>
                <h3 class="font-medium text-turquoise uppercase mb-1">
                    Stay on Track ✅
                </h3>
                <p class="text-gray-600 text-sm">
                    Never lose track of what you need – everything is organized and easy to find 🔍
                </p>
            </li>
        </ul>
    </section>

@guest
    <div class="flex gap-3">
        <a class="underline text-xs text-gray-600 hover:text-gray-900 rounded-md"
           href="{{ route('login') }}">
            <x-button class="ms-3">
                {{ __('Log in') }}
            </x-button>
        </a>

        <a class="underline text-xs text-gray-600 hover:text-gray-900 rounded-md"
           href="{{ route('register') }}">
            <x-button class="ms-3">
                {{ __('Create an account') }}
            </x-button>
        </a>
    </div>
    @endguest
    @auth
        <a class="underline text-xs text-gray-600 hover:text-gray-900 rounded-md"
           href="{{ route('dashboard') }}">
            <x-button class="ms-3">
                {{ __('Dashboard') }}
            </x-button>
        </a>
    @endauth
</x-guest-layout>
