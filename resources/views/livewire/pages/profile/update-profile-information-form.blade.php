<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public string $firstname = '';
    public string $lastname = '';
    public string $username = '';
    public string $email = '';
    public string $editing = '';

    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->firstname = Auth::user()->firstname;
        $this->lastname = Auth::user()->lastname;
        $this->username = Auth::user()->username;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }
    public function save()
    {
        $this->editing = '';

        $this->dispatch('updated');
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword()
    {
        $validated = $this->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        auth()->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);

        $this->editing = '';

        $this->dispatch('password-updated');
    }
}; ?>

<section class="p-8 bg-light-white shadow rounded-xl max-w-xl">
    <form wire:submit="updateProfileInformation" class=" space-y-6">
        <div class="flex gap-4 lg:gap-8 items-center">
            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Profilbild"
                 class="w-15 h-15  lg:w-20 lg:h-20 rounded-full">
            <div class="flex flex-col gap-1">
                <p class="text-s ">{{Auth::user()->firstname }} {{Auth::user()->lastname }}</p>
                <p class="text-xs">{{Auth::user()->username}}</p>
            </div>
        </div>
        <!-- Firstname -->
        <x-form.display-field
            label="Firstname"
            value="{{ $firstname }}"
            model="firstname"
            :editable="true"
            :editing="$editing"
        />

        <!-- Lastname -->
        <x-form.display-field
            label="Lastname"
            value="{{ $lastname }}"
            model="lastname"
            :editable="true"
            :editing="$editing"
        />
        <!-- Username -->
        <x-form.display-field
            label="Username"
            value="{{ $username }}"
            model="username"
            :editable="true"
            :editing="$editing"
        />
        <!-- Email -->
        <x-form.display-field
            label="Email"
            value="{{ $email }}"
            model="email"
            :editable="true"
            :editing="$editing"
        />
        @php
            $user = auth()->user();
        @endphp
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2 text-xs text-gray-800">
                <p> {{ __('Your email address is unverified.') }}</p>
                <button
                    wire:click.prevent="sendVerification"
                    class="underline text-xs text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-turquoise">
                    {{ __('Click here to re-send the verification email.') }}
                </button>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-xs text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif


        <!-- Passwort -->
        <x-form.display-password-field :editing="$editing" />




    </form>
</section>
