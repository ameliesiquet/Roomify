<x-guest-layout class="flex flex-col justify-center w-full max-w-2xl lg:max-w-none">
    <div class="mb-2">
        <h1 class="font-medium text-xl mb-2">Welcome to Roomify!</h1>
        <p class="text-gray-600">Plan your move with ease 🏠✨</p>
    </div>

    <section class="mb-8 flex flex-col gap-2">
        <p class="text-gray-700 text-sm">
            Moving to a new place can be overwhelming 📦.
        </p>
        <p class="text-gray-700 text-sm">
            Roomify helps you stay organized by letting you save furniture and decor items directly into specific rooms, instead of losing track in endless favorites lists 🎯.
        </p>
    </section>

    <div class="lg:hidden mb-8  flex  gap-4">
        <div class="rounded-lg overflow-hidden shadow-lg ">
            <img
                src="{{ asset('images/rooms.png') }}"
                alt="Roomify App Preview"
                class="w-full h-auto"
            >
        </div>
        <div class="rounded-lg overflow-hidden shadow-lg hidden md:block">
            <img
                src="{{ asset('images/budget.png') }}"
                alt="Roomify App Preview"
                class="w-full h-auto"
            >
        </div>
    </div>

    <section class="mb-8">
        <h2 class="text-sm uppercase font-medium text-gray-900 mb-4">Key Features</h2>

        <ul class="space-y-6">
            <li class="flex gap-4">
                <span class="text-xl flex-shrink-0">🚪</span>
                <div>
                    <h3 class="font-medium text-turquoise uppercase mb-1 text-sm">
                        Organize by Room
                    </h3>
                    <p class="text-gray-600 text-sm">
                        Sort your furniture and decor items into different rooms for better overview
                    </p>
                </div>
            </li>

            <li class="flex gap-4">
                <span class="text-xl flex-shrink-0">💰</span>
                <div>
                    <h3 class="font-medium text-turquoise uppercase mb-1 text-sm">
                        Track Your Budget
                    </h3>
                    <p class="text-gray-600 text-sm">
                        Set a total budget and see exactly how much you've spent and what's left 💸
                    </p>
                </div>
            </li>

            <li class="flex gap-4">
                <span class="text-xl flex-shrink-0">✅</span>
                <div>
                    <h3 class="font-medium text-turquoise uppercase mb-1 text-sm">
                        Stay on Track
                    </h3>
                    <p class="text-gray-600 text-sm">
                        Never lose track of what you need – everything is organized and easy to find 🔍
                    </p>
                </div>
            </li>
        </ul>
    </section>

    @guest
        <div class="flex gap-3 justify-start pt-6 border-t border-gray-200">
            <a href="{{ route('login') }}">
                <x-button>
                    {{ __('Log in') }}
                </x-button>
            </a>

            <a href="{{ route('register') }}">
                <x-button>
                    {{ __('Create an account') }}
                </x-button>
            </a>
        </div>
    @endguest

    @auth
        <div class="flex justify-start pt-6 border-t border-gray-200">
            <a href="{{ route('dashboard') }}">
                <x-button>
                    {{ __('Dashboard') }}
                </x-button>
            </a>
        </div>
    @endauth
</x-guest-layout>
