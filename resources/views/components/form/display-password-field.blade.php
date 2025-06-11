@props(['editing' => null])

@php
    $isEditing = $editing === 'password';
@endphp

<div class="w-full border-b border-gray-300 flex flex-col justify-between items-left gap-2 pb-1">
    <p class="text-s text-gray-600">Password</p>

    <div class="flex flex-col gap-2">
        @if ($isEditing)
            <x-form.input-password
                label="Current password"
                name="current_password"
                model="current_password"
                placeholder="Current password"
                required
            />

            <x-form.input-password
                label="New password"
                name="password"
                model="password"
                placeholder="New password"
                required
            />

            <x-form.input-password
                label="Confirm password"
                name="password_confirmation"
                model="password_confirmation"
                placeholder="Confirm password"
                required
            />

            <div class="flex gap-3 items-center">
                <x-button wire:click="updatePassword">Save</x-button>
                <x-button wire:click="$set('editing', '')">Cancel</x-button>
            </div>
        @else
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-800 font-medium">********</p>

                <button
                    wire:click="$set('editing', 'password')"
                    class="text-xs text-turquoise hover:underline cursor-pointer ml-2"
                >
                    edit
                </button>
            </div>
        @endif
    </div>
</div>
