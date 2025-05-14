<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();
        logger('Validation passed, now calling authenticate');

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>
<div class="m-auto flex flex-col gap-4">
    <h1 class="uppercase text-center text-turquoise">Login</h1>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>
    <form wire:submit="login" class="bg-light-sand py-4 px-8 rounded-xl shadow-md flex flex-col gap-4">
        <!--Username -->
        <x-form.field-label-input
            label="Username"
            name="username"
            type="text"
            model="form.username"
            placeholder="your_name"
            autocomplete="username"
            autofocus
            required
            class="lowercase"
        />
        <!-- Password -->
        <div class="block flex flex-col gap-2">
            <x-form.input-password
                label="Password"
                name="password"
                model="form.password"
                autocomplete="current-password"
                required
            />
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-xs text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col gap-2 items-center justify-end mt-4">
            <x-button class="ms-3">
                {{ __('Log in') }}
            </x-button>

            @if (Route::has('password.request'))
                <a class="underline text-xs text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif

        </div>
    </form>
</div>
