<div class="max-w-[80%] mx-auto px-10 py-10 bg-mybeige rounded-lg shadow-md flex flex-col gap-4">
    <p class="text-sm text-gray-600">
        {{ __('Forgot your password? 😅 No stress! Just enter your email 📩 and we’ll send you a reset link ⚡️') }}
    </p>
    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-2">
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
        <div class="flex items-center justify-start mt-4">
            <x-button>
                {{ __('Email Password Reset Link') }}
            </x-button>
        </div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
    </form>
</div>
