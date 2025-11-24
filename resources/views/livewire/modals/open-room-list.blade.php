<!-- MODAL -->
<div
    x-show="showRoomListModal"
    x-cloak
    class="fixed inset-0 bg-black/40 flex items-center justify-center p-4 z-100"
    @click.self="selectedItem = null"
>
    <article class="bg-white p-6 rounded-xl w-full max-w-4xl shadow-xl z-50">

        <button
            class="mb-4 cursor-pointer"
            @click="selectedItem = null"
        >
            <x-svg.arrow-left></x-svg.arrow-left>
        </button>


        <div class="bg-white rounded-lg shadow p-4 w-72">
            <h2 class="text-lg font-semibold mb-3">Add to Room</h2>

            <!-- User Rooms -->
            <template x-for="room in userRooms" :key="room.id">
                <button class="w-full text-left px-3 py-2 hover:bg-gray-100 rounded mb-1"
                        @click="console.log('Add item', selectedRoomItemId, 'to room', room.id)">
                    <span x-text="room.name"></span>
                </button>
            </template>

            <hr class="my-2">

            <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700"
                    @click="console.log('Open Add Room Modal');">
                + New Room
            </button>
        </div>
    </article>
</div>
