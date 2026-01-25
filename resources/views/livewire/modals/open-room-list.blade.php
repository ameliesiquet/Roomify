<!-- MODAL -->

<div
    x-show="showRoomListModal"
    x-cloak
    class="fixed inset-0 bg-black/40 flex items-center justify-center p-4 z-100"
    @click.self="showRoomListModal = false"
>

    <article class="bg-white p-4 rounded-xl max-w-4xl shadow-xl z-50">

        <button
            class="mb-2 cursor-pointer"
            @click="showRoomListModal = false"
        >
            <x-svg.arrow-left></x-svg.arrow-left>
        </button>

        <div class="w-60">
            <x-texts.modal-section-header title="Add to Room" :editable="false"></x-texts.modal-section-header>
            <template x-if="!userRooms || userRooms.length === 0">
                <div class="flex flex-col items-left justify-center  text-left gap-2 py-2">
                    <p class="text-gray-700 text-sm">
                        No rooms yet ... <br>
                    </p>
                    <a href="/rooms" class="text-turquoise underline text-xs">Create my first room</a>
                </div>
            </template>
            <template x-for="room in userRooms" :key="room.id">
                <button
                    class="w-full text-left py-2 rounded mb-1 text-xs"
                    :class="selectedRoomId === room.id
                        ? 'bg-gray-200 font-semibold'
                        : 'hover:bg-gray-100'"
                    @click="selectedRoomId = room.id"
                >
                    <span x-text="room.name"></span>
                </button>
            </template>

            <button
                class="bg-turquoise text-white p-2 rounded mb-2 text-sm mt-2 w-full"
                :disabled="!selectedRoomId"
                @click="
        $wire.addItemToRoom(selectedRoomItemId, selectedRoomId)
            .then(() => {
                successMessage = 'Item successfully added!';
                showRoomListModal = false;
                selectedRoomId = null;
                selectedRoomItemId = null;
                setTimeout(() => successMessage = '', 3000);
            });
    "
            >
                Save
            </button>

        </div>
    </article>
</div>
