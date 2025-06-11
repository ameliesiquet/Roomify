<div class="max-w-[80%] mx-auto px-10 py-10 bg-mybeige rounded-lg shadow-md flex flex-col gap-4">
    <p class="text-sm text-gray-600">
        {{ __('You‘re almost there! Just enter your new password and confirm it — then you‘re good to go 💪') }}
    </p>
    <form wire:submit="resetPassword" class="flex flex-col gap-2">
        <div class="flex flex-col gap-4">
            <!-- Email Address -->
            <x-form.field-label-input
                    label="Email"
                    name="email"
                    type="email"
                    model="email"
                    placeholder="your-email@gmail.com"
                    autocomplete="email"
                    autofocus
                    required
                    class="lowercase"
            />

            <!-- Password -->
            <x-form.input-password
                    label="Password"
                    name="password"
                    :model="'password'"
                    placeholder="Your new password"
                    autocomplete="current-password"
                    required
            />

            <!-- Confirm Password -->
            <x-form.input-password
                    label="Confirm password"
                    name="password_confirmation"
                    model="password_confirmation"
                    placeholder="Confirm new password"
                    required
            />
        </div>
        <div class="flex items-center justify-start mt-4">
            <x-button>
                {{ __('Reset Password') }}
            </x-button>
        </div>
        <!-- Session Status -->
        @if ($message)
            <div class="text-sm text-green-600 mt-2">
                {{ $message }}
            </div>
        @endif

        @if ($resetSuccessful)
            <a href="{{ route('login') }}" class="underline text-xs text-gray-600 hover:text-gray-900 ">
                👉 Back to Login
            </a>
        @endif

    </form>
</div>
