<section
    x-data="{
        selectedItem: null,
        selectedCategory: 'all',
        showRoomListModal: false,
        selectedRoomItemId: null,
        successMessage: '',
        userRooms: @js($rooms),
        selectedRoomId: @js($rooms->first()->id ?? null),

        openRoomListModal(itemId) {
            this.selectedRoomItemId = itemId;
            this.showRoomListModal = true;
        },

        closeRoomListModal() {
            this.showRoomListModal = false;
            this.selectedRoomItemId = null;
            this.selectedRoomId = this.userRooms.length > 0 ? this.userRooms[0].id : null;
        },
    }"
    class="relative"
>


    <div x-show="successMessage" x-transition class="text-green-600 z-50 mb-8 text-sm">
        <span x-text="successMessage"></span>
    </div>
    @foreach($messages as $message)
        <x-dynamic-component
            :component="$message['component']"
            :attributes="$message['props'] ?? []"
        />
    @endforeach

    @if($categories->isNotEmpty())
        <div class="flex gap-2 overflow-x-auto mb-4">
            <button
                @click="selectedCategory = 'all'"
                :class="selectedCategory === 'all' ? 'underline font-semibold' : 'text-gray-500 hover:text-black'"
                class="px-2 py-2 text-sm whitespace-nowrap"
            >
                All
            </button>

            @foreach ($categories as $category)
                <button
                    @click="selectedCategory = '{{ $category }}'"
                    :class="selectedCategory === '{{ $category }}' ? 'underline font-semibold' : 'text-gray-500 hover:text-black'"
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

    <x-partials.items-grid
        :items="$items"
        :showCategoryFilter="true"
        selectedCategory="selectedCategory"
        :onItemClick="'selectedItem = item'"
        :plusButtonAction="'openRoomListModal(item.id)'"
    />


    @include('livewire.modals.selected-item')
    @include('livewire.modals.open-room-list')
</section>
