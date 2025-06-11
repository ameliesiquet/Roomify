<x-guest-layout class="flex flex-col justify-center">
    <h1 class="font-medium text-lg">Welcome to Roomify!</h1>
    <section class="flex flex-col items-center justify-center">
        <h2 class="text-sm">A short explanation of this application:</h2>
    </section>
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
</x-guest-layout>
