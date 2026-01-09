<!-- MODAL -->

<div
    x-show="showRoomListModal"
    x-cloak
    class="fixed inset-0 bg-black/40 flex items-center justify-center p-4 z-100"
    @click.self="showRoomListModal = false"
    successMessage: '',
>

    <article class="bg-white p-4 rounded-xl max-w-4xl shadow-xl z-50">

        <button
            class="mb-2 cursor-pointer"
            @click="showRoomListModal = false"
        >
            <x-svg.arrow-left></x-svg.arrow-left>
        </button>

        <div class="w-60">
            <h2 class="text-md font-semibold mb-3">Add to Room</h2>

            <!-- Users Rooms -->
            <template x-for="room in userRooms" :key="room.id">
                <button
                    class="w-full text-left px-3 py-2 rounded mb-1 text-sm"
                    :class="selectedRoomId === room.id
                        ? 'bg-gray-200 font-semibold'
                        : 'hover:bg-gray-100'"
                    @click="selectedRoomId = room.id"
                >
                    <span x-text="room.name"></span>
                </button>
            </template>




            <button
                class="text-black py-2 rounded hover:font-bold w-full text-left"
                @click="console.log('Open Add Room Modal');"
            >
                + new
            </button>

            <!-- Save Button -->
            <button class="bg-turquoise text-white p-2 rounded mb-2 disabled:opacity-40 text-sm mx-auto"
                    :disabled="!selectedRoomId"
                    @click="
        console.log('Add item', selectedRoomItemId, 'to room', selectedRoomId);
        successMessage = 'Item successfully added to ' + userRooms.find(r => r.id === selectedRoomId).name + '!';
        showRoomListModal = false;
        selectedRoomId = null;
        setTimeout(() => successMessage = '', 3000); // Message disappears after 3 seconds
    ">
                Save
            </button>


        </div>
    </article>
</div>
