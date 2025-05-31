<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component {
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $edit_password = false;


    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

    <!-- Passwort-Anzeige oder Formular -->
<div>
    @if (! $edit_password)
        <x-form.display-field
            label="Password"
            value="********"
        >
            <x-slot:action>
                <button wire:click="$set('edit_password', true)" class="text-sm text-blue-600 hover:underline">
                    {{ __('Edit') }}
                </button>
            </x-slot:action>
        </x-form.display-field>
    @else
        <div class="space-y-4">
            <x-form.field-label-input
                label="Current Password"
                name="current_password"
                type="password"
                model="current_password"
                autocomplete="current-password"
            />

            <x-form.field-label-input
                label="New Password"
                name="password"
                type="password"
                model="password"
                autocomplete="new-password"
            />

            <x-form.field-label-input
                label="Confirm Password"
                name="password_confirmation"
                type="password"
                model="password_confirmation"
                autocomplete="new-password"
            />

            <div class="flex items-center gap-3">
                <x-button wire:click="updatePassword">
                    {{ __('Save') }}
                </x-button>

                <button wire:click="$set('edit_password', false)" class="text-sm text-gray-600 hover:underline">
                    {{ __('Cancel') }}
                </button>

                <x-action-message on="password-updated" class="text-green-600">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </div>
    @endif
</div>
