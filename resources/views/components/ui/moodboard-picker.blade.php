@props([
    'colors' => [],
    'editable' => true,
])

<div class="flex flex-wrap gap-4">
    @foreach($colors as $index => $color)
        <div class="flex items-center gap-2">
            <div class="relative w-6 h-6">
                {{-- Visible circle --}}
                <div
                    class="w-6 h-6 rounded-full border border-gray-300"
                    style="background-color: {{ $color }}"
                ></div>

                @if($editable)
                    {{-- Hidden color picker --}}
                    <input
                        type="color"
                        {{ $attributes->whereStartsWith('wire:model')->first() }}
                        class="absolute inset-0 opacity-0 cursor-pointer"
                    />
                @endif
            </div>

            @if($editable)
                <button
                    type="button"
                    {{ $attributes->whereStartsWith('wire:remove')->first() }}
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
            class="w-6 h-6 flex items-center justify-center rounded-full
                   border border-dashed border-gray-300
                   text-gray-400 hover:border-gray-500 hover:text-gray-600"
        >
            +
        </button>
    @endif
</div>
