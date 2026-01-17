<section
    x-data="{
        selectedRoomId: null,
        selectedRoom: null,
        successMessage: '',
        userRooms: @js($rooms),
        selectedRoomItemId: null,
        showRoomListModal: false,

        openRoomListModal(itemId) {
            this.selectedRoomItemId = itemId;
            this.showRoomListModal = true;
        },
        closeRoomListModal() {
            this.showRoomListModal = false;
        }
    }"
    class="relative"
>
    <div x-show="successMessage" x-transition class="text-green-600 z-50 mb-8 text-sm">
        <span x-text="successMessage"></span>
    </div>

    @foreach($messages as $message)
        <x-dynamic-component
            :component="$message['component']"
            v-bind="$message['props'] ?? []"
        />
    @endforeach

    {{-- ROOM-LEISTE --}}
    <div class="flex items-center gap-4 overflow-x-auto mb-8">
        @foreach ($rooms as $room)
            <button
                @click="selectedRoomId = {{ $room->id }}; selectedRoom = null"
                :class="selectedRoomId === {{ $room->id }}
                    ? 'underline font-semibold'
                    : 'text-black hover:font-bold cursor-pointer'"
                class="px-2 py-2 text-sm rounded-md whitespace-nowrap"
            >
                {{ ucfirst($room->name) }}
            </button>
        @endforeach

        <button
            wire:click="openAddRoomModal"
            class="cursor-pointer flex items-center gap-2 px-2 py-1.5 border rounded-lg text-sm hover:bg-gray-100 whitespace-nowrap"
        >
            Add <x-svg.plus class="w-4 h-4"/>
        </button>
    </div>

    {{-- ITEMS GRID FÜR AUSGEWÄHLTEN RAUM --}}
    <div x-show="selectedRoomId">
        @foreach($rooms as $room)
            <div x-show="selectedRoomId === {{ $room->id }}" x-cloak>

                {{-- Show Details Button --}}
                <div class="mb-6">
                    <button
                        type="button"
                        wire:click="openRoomDetailsModal({{ $room->id }})"
                        class="text-xs md:text-sm lg:text-base px-4 py-2 text-white bg-turquoise rounded-lg cursor-pointer hover:bg-turquoise/90"
                    >
                        Show details
                    </button>
                </div>

                {{-- ITEMS GRID COMPONENT --}}
                @if($room->items && $room->items->count() > 0)
                    <x-partials.items-grid
                        :items="$room->items"
                        :showCategoryFilter="false"
                        :onItemClick="'selectedItem = item'"
                        :plusButtonAction="'openRoomListModal({itemId})'"
                    />
                @else
                    <div class="text-center py-12 text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <p class="text-lg font-semibold mb-2">No items in this room yet</p>
                        <p class="text-sm text-gray-600 mb-4">Start adding items from the shopping page</p>
                        <a href="{{ route('shopping') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-turquoise text-white rounded-lg hover:bg-turquoise/90">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            Go Shopping
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    @include('livewire.modals.add-room')
    @include('livewire.modals.room-details')
    @include('livewire.modals.open-room-list') {{-- Plus-Button Modal --}}
</section>
