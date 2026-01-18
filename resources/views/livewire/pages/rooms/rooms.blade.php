<section
    x-data="{
        selectedRoomId: {{ $rooms->first()->id ?? 'null' }},
        selectedRoom: null,
        successMessage: '',
        userRooms: @js($rooms),
        selectedRoomItemId: null,
        showRoomListModal: false,
        selectedCategory: 'all',

        openRoomListModal(itemId) {
            this.selectedRoomItemId = itemId;
            this.showRoomListModal = true;
        },
        closeRoomListModal() {
            this.showRoomListModal = false;
        },
        getRoomById(roomId) {
            return this.userRooms.find(r => r.id === roomId);
        },
        getFilteredItems(room) {
            if (!room || !room.items) return [];
            if (this.selectedCategory === 'all') return room.items;
            return room.items.filter(item => item.category === this.selectedCategory);
        }
    }"
    class="relative"
>
    {{-- Success --}}
    <div x-show="successMessage" x-transition class="text-green-600 z-50 mb-8 text-sm">
        <span x-text="successMessage"></span>
    </div>

    {{-- Messages --}}
    @foreach($messages as $message)
        <x-dynamic-component
            :component="$message['component']"
            v-bind="$message['props'] ?? []"
        />
    @endforeach

    {{-- Room Navigation --}}
    <div class="flex items-center gap-4 overflow-x-auto mb-8">
        @foreach ($rooms as $room)
            <button
                @click="selectedRoomId = {{ $room->id }}; selectedCategory = 'all'"
                :class="selectedRoomId === {{ $room->id }}
                    ? 'underline font-semibold'
                    : 'text-black hover:font-bold'"
                class="px-2 py-2 text-sm whitespace-nowrap"
            >
                {{ ucfirst($room->name) }}
            </button>
        @endforeach

        <button
            wire:click="openAddRoomModal"
            class="flex items-center gap-2 px-2 py-1.5 border rounded-lg text-sm hover:bg-gray-100 whitespace-nowrap"
        >
            Add <x-svg.plus class="w-4 h-4"/>
        </button>
    </div>

    {{-- Selected Room --}}
    <div x-show="selectedRoomId">
        @foreach($rooms as $room)
            <div x-show="selectedRoomId === {{ $room->id }}" x-cloak>

                {{-- HEADER --}}
                <div class="mb-8">
                    <div class="grid grid-cols-1 lg:grid-cols-[auto_1fr] gap-6 items-baseline max-w-6xl">

                        {{-- Budget Box --}}
                        <div
                            class="bg-white rounded-2xl shadow-sm p-6
                                   flex flex-col sm:flex-row sm:items-center gap-4
                                   w-fit lg:sticky lg:top-24"
                        >
                            <x-ui.budget-widget
                                :spent="$room->spent"
                                :budget="$room->budget"
                                variant="compact"
                                circleSize="sm"
                            />

                            <x-buttons.turquoise-button
                                wire:click="openRoomDetailsModal({{ $room->id }})"
                                class="whitespace-nowrap self-baseline sm:self-center max-w-full"
                            >
                                all details
                            </x-buttons.turquoise-button>
                        </div>

                        {{-- Categories --}}
                        @if($room->items && $room->items->count() > 0)
                            <div
                                class="flex gap-2 overflow-x-auto pb-2
                                       lg:pt-3
                                      "
                            >
                                <button
                                    @click="selectedCategory = 'all'"
                                    :class="selectedCategory === 'all'
                                        ? 'underline font-semibold'
                                        : 'text-gray-500 hover:text-black'"
                                    class="px-2 py-2 text-sm whitespace-nowrap"
                                >
                                    All
                                </button>

                                @php
                                    $categories = $room->items->pluck('category')->unique()->filter();
                                @endphp

                                @foreach ($categories as $category)
                                    <button
                                        @click="selectedCategory = '{{ $category }}'"
                                        :class="selectedCategory === '{{ $category }}'
                                            ? 'underline font-semibold'
                                            : 'text-gray-500 hover:text-black'"
                                        class="flex items-center gap-2 px-2 py-2 text-sm whitespace-nowrap"
                                    >
                                        <x-dynamic-component
                                            :component="'svg.' . strtolower($category)"
                                            class="w-4 h-4"
                                        />
                                        {{ ucfirst($category) }}
                                    </button>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>

                {{-- ITEMS --}}
                @if($room->items && $room->items->count() > 0)
                    <x-partials.items-grid
                        :items="$room->items"
                        :showCategoryFilter="true"
                        selectedCategory="selectedCategory" {{-- einfach als String für Alpine --}}
                        :onItemClick="'selectedItem = item'"
                        :plusButtonAction="'openRoomListModal(item.id)'" {{-- hier die Änderung --}}
                        :showRemoveButton="true"
                        :removeButtonAction="'removeItemFromRoom(item.id, '.$room->id.')'"
                    />



                @else
                    <x-ui.messages.no-item-in-room-message></x-ui.messages.no-item-in-room-message>
                @endif

            </div>
        @endforeach
    </div>

    @include('livewire.modals.add-room')
    @include('livewire.modals.room-details')
    @include('livewire.modals.open-room-list')
</section>
