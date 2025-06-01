@props(['editing' => false])

@if ($editing)
    <div class="flex gap-3 items-center">
        <x-button wire:click="save">{{ __('Save') }}</x-button>
        <x-button wire:click="cancelEdit" variant="secondary">
            {{ __('Cancel') }}
        </x-button>
    </div>
@endif
