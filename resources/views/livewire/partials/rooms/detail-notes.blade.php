<section>
    <x-texts.modal-section-header
        title="Notes"
        wire:click="edit"
    />

    <div class="bg-white p-6 rounded-2xl shadow-sm">
        <div class="bg-[#F8F4EC] p-6 rounded-lg w-full">
            @if($editingNotes)
                <textarea
                    wire:model.defer="notesDraft"
                    class="w-full rounded-lg border-gray-300 text-xs"
                    placeholder="Write your notes…"
                ></textarea>

                <div class="mt-4 flex justify-end gap-2">
                    <x-buttons.white-button wire:click="cancel">
                        Cancel
                    </x-buttons.white-button>

                    <x-buttons.turquoise-button wire:click="save">
                        Save
                    </x-buttons.turquoise-button>
                </div>
            @else
                @if($room->notes)
                    <p class="text-xs text-gray-700">{{ $room->notes }}</p>
                @else
                    <p class="text-xs text-gray-400 italic">No notes yet...</p>
                @endif
            @endif
        </div>
    </div>
</section>
