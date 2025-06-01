<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
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
    <h2 class="text-s text-gray-600">
        {{ __('Delete your account') }}
    </h2>
    <p class="text-xs text-gray-800 font-medium leading-6">
        Thinking about leaving already? 😢
        Looks like your dream apartment is all set up and you don’t need us anymore!
        If you ever feel like rearranging or starting fresh, we’ll be right here. 💫
    </p>

    <!-- Button to open modal -->
    <x-button x-data @click="$dispatch('open-modal')">
        Delete Account
    </x-button>
    <!-- Modal Container -->
    <div
        x-data="{ open: false }"
        x-on:open-modal.window="open = true"
        x-on:close-modal.window="open = false"
        x-show="open"
        focusable
        style="display: none;"
        class="fixed inset-0 flex items-center justify-center bg-black/30 z-50"
    >
        <form wire:submit="deleteUser" class="p-6 z-50 b bg-mywhite rounded-2xl">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Ready to say goodbye? 💔') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ __('If you delete your account, all your rooms, items, and data will be gone forever. 🗂️
                        Please enter your password to confirm — and remember, you‘re always welcome back. 🏡')
                        }}
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
                <x-button type="button" x-on:click="$dispatch('close-modal')">
                    {{ __('Cancel') }}
                </x-button>
                <x-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-button>
            </div>
        </form>
    </div>
</section>


