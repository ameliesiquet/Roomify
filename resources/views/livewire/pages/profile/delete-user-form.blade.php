<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="py-4 px-8 bg-white shadow rounded-xl max-w-xl flex flex-col gap-2 items-baseline">
    <header class="flex flex-col gap-2">
        <h2 class="text-s text-gray-600">
            {{ __('Delete your account') }}
        </h2>
        <p class="text-xs text-gray-800 font-medium leading-6">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>
    <x-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-button>

    <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser" class="p-6">

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6 space-y-3">
                <x-form.field-label-input
                    label="{{ __('Password') }}"
                    name="password"
                    type="password"
                    model="password"
                    placeholder="{{ __('Password') }}"
                    autocomplete="current-password"
                />

            </div>
            <div class="mt-6 flex justify-end">
                <x-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-button>

                <x-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-button>
            </div>
        </form>
    </x-modal>
</section>
