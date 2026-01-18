<section>
    <x-texts.modal-section-header
        title="Title"
        wire:click="edit"
    />

    @if($editing)
            <input
                type="text"
                wire:model.defer="titleDraft"
                class="w-full rounded-lg border-gray-300 text-xs px-4 py-2"
                placeholder="Room title"
            />

            <div class="mt-4 flex justify-start gap-2">
                <x-buttons.white-button wire:click="cancel">
                    Cancel
                </x-buttons.white-button>

                <x-buttons.turquoise-button wire:click="save">
                    Save
                </x-buttons.turquoise-button>
            </div>
        @else
            <p class="text-xs text-gray-800 font-medium">
                {{ $room->name }}
            </p>
        @endif
</section>
