<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>
<div class="m-auto flex flex-col gap-4">
    <h1 class="uppercase text-center text-turquoise">Register</h1>
    <form wire:submit="register" class="mx-auto px-4  bg-light-sand lg:py-6 lg:px-8 rounded-xl shadow-lg flex flex-col gap-4 text-xs w-[80%]">
        <x-svg.camera-register />
        <!-- Name -->
        <div class="flex justify-between gap-4">
            <!-- Firstname -->
            <x-form.field-label-input
                label="Firstname"
                name="firstname"
                model="form.firstname"
                placeholder="Your firstname"
                autocomplete="firstname"
                autofocus
                required
                class="capitalize"
            />
            <!-- Lastname -->
            <x-form.field-label-input
                label="Lastname"
                name="lastname"
                model="form.lastname"
                placeholder="Your lastname"
                autocomplete="lastname"
                autofocus
                required
                class="capitalize"
            />
        </div>
        <!-- Email -->
        <x-form.field-label-input
            label="Email"
            name="email"
            type="email"
            model="form.email"
            placeholder="your-email@gmail.com"
            autocomplete="email"
            autofocus
            required
            class="lowercase"
        />
        <!-- Phone -->
        <x-form.field-label-input
            label="Phone"
            name="phone"
            model="form.phone"
            placeholder="+32 123 456 789"
            autocomplete="tel"
        />
        <!-- Username -->
        <x-form.field-label-input
            label="Username"
            name="username"
            model="form.username"
            placeholder="your_username"
            autocomplete="username"
            required
            class="lowercase"
        />
        <!-- Password -->
        <x-form.input-password
            label="Password"
            name="password"
            model="form.password"
            autocomplete="new-password"
            required
        />
        <div class="flex flex-col gap-4 items-center justify-end mt-4">
            <x-button >Create my account</x-button>
            <a class="underline text-xs text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
               href="{{ route('login') }}" wire:navigate>
                {{ __('I already have an account -> login') }}
            </a>
        </div>
    </form>
</div>
<!-- TODO : make register fuctionnal, check login, check responisv of forms, make camera icon fucntional -->
