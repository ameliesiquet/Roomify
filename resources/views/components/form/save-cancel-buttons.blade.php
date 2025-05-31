@props(['editing' => null])
@if ($editing)
    <div class="flex gap-3 items-center">
        <x-button wire:click="save">{{ __('Save') }}</x-button>
        <x-button wire:click="$set('editing', '')" variant="secondary">
            {{ __('Cancel') }}
        </x-button>
    </div>
@endif
