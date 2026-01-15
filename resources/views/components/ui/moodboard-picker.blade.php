@props([
    'colors' => [],
    'editable' => true,
])

<div class="flex flex-wrap gap-4">
    @foreach($colors as $index => $color)
        <div class="flex items-center gap-2">
            <input
                type="color"
                {{ $editable ? $attributes->whereStartsWith('wire:model')->first() : 'disabled' }}
                class="w-6 h-6 rounded-full border border-gray-300 cursor-pointer"
            />

            @if($editable)
                <button
                    type="button"
                    {{ $attributes->whereStartsWith('wire:click')->first() }}
                    class="text-xs text-gray-400 hover:text-red-500"
                >
                    ✕
                </button>
            @endif
        </div>
    @endforeach

    @if($editable)
        <button
            type="button"
            {{ $attributes->whereStartsWith('wire:add')->first() }}
            class="w-6 h-6 flex items-center justify-center rounded-full border border-dashed border-gray-300 text-gray-400"
        >
            +
        </button>
    @endif
</div>
