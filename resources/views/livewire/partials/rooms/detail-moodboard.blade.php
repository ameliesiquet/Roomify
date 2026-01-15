<section>
    <x-texts.modal-section-header
        title="Moodboard"
        wire:click="edit"
    />

    <div class="bg-white p-6 rounded-2xl shadow-sm">
        @if($editing)
            <div class="flex flex-wrap gap-4">
                @foreach($colorsDraft as $index => $color)
                    <div class="flex items-center gap-2">
                        <input
                            type="color"
                            wire:model="colorsDraft.{{ $index }}"
                            class="w-6 h-6 rounded-full border border-gray-300 cursor-pointer"
                        />

                        <button
                            wire:click="removeColor({{ $index }})"
                            class="text-xs text-gray-400 hover:text-red-500"
                        >
                            ✕
                        </button>
                    </div>
                @endforeach

                <button
                    wire:click="addColor"
                    class="w-6 h-6 flex items-center justify-center rounded-full border border-dashed border-gray-300 text-gray-400 hover:border-gray-500 hover:text-gray-600"
                >
                    +
                </button>
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <x-buttons.white-button wire:click="cancel">
                    Cancel
                </x-buttons.white-button>
                <x-buttons.turquoise-button wire:click="save">
                    Save
                </x-buttons.turquoise-button>
            </div>
        @else
            @php
                $colors = $room->colors ?? [];
            @endphp

        @if(count($colors))
                <div class="flex flex-wrap gap-2">
                    @foreach($colors as $color)
                        <div
                            class="w-5 h-5 rounded-full border border-gray-200"
                            style="background-color: {{ $color }}"
                            title="{{ $color }}"
                        ></div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-400 italic">
                    No colors yet...
                </p>
            @endif
        @endif
    </div>
</section>
